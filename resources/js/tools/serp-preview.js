// Vite entry: SERP Preview (enhanced)
(function(){
  const ready = (fn)=>document.readyState!=='loading'?fn():document.addEventListener('DOMContentLoaded',fn);
  const $ = (id)=>document.getElementById(id);

  const state = {
    engine: 'google',
    viewport: 'desktop',
    fetchEnabled: false,
    fetching: false,
    google: {
      modern: true,
      showDate: false,
      showRating: false,
    }
  };

  const LIMITS = { title: 65, desc: 160 };

  function updateCounters(){
    const tEl = $('serpTitle'); const dEl = $('serpDescription');
    $('titleCount').textContent = `${tEl.value.length} / ${LIMITS.title}`;
    $('descCount').textContent = `${dEl.value.length} / ${LIMITS.desc}`;
    // color warn
    $('titleCount').className = `text-xs ml-1 ${tEl.value.length>LIMITS.title? 'text-red-600':'text-gray-500'}`;
    $('descCount').className = `text-xs ml-1 ${dEl.value.length>LIMITS.desc? 'text-red-600':'text-gray-500'}`;
  }

  function render(){
    const out = $('serpResults'); if(!out) return;
    const titleRaw = $('serpTitle').value.trim();
    const descRaw = $('serpDescription').value.trim();
    const titleTrunc = pixelTruncate(titleRaw || 'Example Title – Brand', state.viewport === 'mobile' ? 380 : 600);
    const descTrunc = pixelTruncateDescription(descRaw || 'Meta description preview will show here. Make it compelling, unique and user‑focused.', state.viewport === 'mobile' ? 14 : 16);
    const boldInput = $('boldKeywords') ? $('boldKeywords').value : '';
    const titleHtml = highlightKeywords(titleTrunc, boldInput);
    const descHtml = highlightKeywords(descTrunc, boldInput);
    const { host, path } = parseUrl($('pageUrl').value.trim());
    const siteName = $('siteName').value.trim() || host || 'example.com';
    out.innerHTML = state.engine==='google' ? (state.google.modern ? googleModernMarkup(titleHtml, descHtml, host, path, siteName) : googleLegacyMarkup(titleHtml, descHtml, host, path, siteName)) : bingMarkup(titleHtml, descHtml, host, path, siteName);
  }

  function googleLegacyMarkup(titleHtml, descHtml, host, path){
    const crumb = path ? path.replace(/\/$/,'').split('/').filter(Boolean).slice(0,2).join(' › ') : 'tools';
    return `<div class="bg-white border rounded-xl p-5 shadow-sm transition-all duration-300" style="max-width: ${state.viewport === 'mobile' ? '380px' : '640px'}">
      <div class="text-[#006621] text-sm mb-1 flex items-center gap-1"><span>${escapeHtml(host||'example.com')}</span><span class="text-gray-400">›</span><span>${escapeHtml(crumb)}</span></div>
      <a href="#" class="block text-[#1a0dab] text-xl leading-snug hover:underline">${titleHtml}</a>
      <div class="text-sm text-gray-700">${descHtml}</div>
    </div>`;
  }

  function googleModernMarkup(titleHtml, descHtml, host, path, siteName){
    const crumb = buildBreadcrumb(path);
    const favicon = generateFavicon(host||siteName);
    const datePrefix = state.google.showDate ? `<span class="text-[#4d5156]">${relativeDate()} — </span>` : '';
    const rating = state.google.showRating ? ratingSnippet() : '';
    return `<div class="bg-white border rounded-xl p-5 shadow-sm transition-all duration-300" style="max-width: ${state.viewport === 'mobile' ? '380px' : '640px'}">
      <div class="flex items-center gap-2">${favicon}<div class="flex flex-col"><span class="text-[#202124] text-[12px] leading-tight">${escapeHtml(siteName)}</span><span class="text-[12px] leading-tight">${escapeHtml(host||'example.com')} › ${escapeHtml(crumb)}</span></div></div>
      <a href="#" class="block text-[#1a0dab] text-[${state.viewport === 'mobile' ? '16' : '20'}px] leading-snug font-normal hover:underline">${titleHtml}</a>
      <div class="text-[${state.viewport === 'mobile' ? '13' : '14'}px] leading-5">${datePrefix}${descHtml}</div>
      ${rating}
    </div>`;
  }

  function bingMarkup(titleHtml, descHtml, host, path, siteName){
    const crumb = path ? path.replace(/\/$/,'').split('/').filter(Boolean).slice(0,2).join(' › ') : 'tools';
    return `<div class="bg-white border rounded-xl p-5 shadow-sm transition-all duration-300" style="max-width: ${state.viewport === 'mobile' ? '380px' : '640px'}">
      <a href="#" class="block text-[#001ba0] text-xl leading-snug hover:underline">${titleHtml}</a>
      <div class="text-xs text-gray-500 mb-1">${escapeHtml(siteName)} — ${escapeHtml(host||'example.com')} / ${escapeHtml(crumb)}</div>
      <div class="text-sm text-gray-700">${descHtml}</div>
    </div>`;
  }

  function escapeHtml(str){
    return str.replace(/[&<>"']/g, c=>({"&":"&amp;","<":"&lt;",">":"&gt;","\"":"&quot;","'":"&#39;"}[c]));
  }

  function parseUrl(raw){
    try {
      if(!raw) return { host: '', path: '' };
      try {
        const u = new URL(raw);
        return { host: u.host.replace(/^www\./, ''), path: u.pathname };
      } catch (err) {
        // forgiving fallback: try with https:// when scheme is omitted
        try { const u2 = new URL('https://' + raw); return { host: u2.host.replace(/^www\./, ''), path: u2.pathname }; } catch (e) { throw err; }
      }
    } catch (e) {
      return { host: '', path: '' };
    }
  }

  function buildBreadcrumb(path){
    if(!path) return 'tools';
    const parts = path.replace(/\/$/,'').split('/').filter(Boolean);
    if(!parts.length) return 'home';
    return parts.slice(0,3).join(' › ');
  }

  // Pixel measurement helpers
  const canvas = document.createElement('canvas');
  const ctx = canvas.getContext('2d');
  function measure(text, font){
    ctx.font = font;
    return ctx.measureText(text).width;
  }

  function pixelTruncate(text, maxPx=600, font='400 20px Arial, sans-serif'){ // approximate Google desktop
    if(!text) return '';
    if(measure(text,font) <= maxPx) return text;
    let lo=0, hi=text.length; let res=text;
    while(lo<hi){
      const mid = Math.floor((lo+hi)/2);
      const candidate = text.slice(0,mid)+ '…';
      if(measure(candidate,font) <= maxPx){ res=candidate; lo=mid+1;} else { hi=mid; }
    }
    return res;
  }

  function pixelTruncateDescription(text, fontSize=14, maxLines=2, lineWidth=920){
    const font = `400 ${fontSize}px Arial, sans-serif`;
    const words = text.split(/\s+/);
    const lines = [];
    let current = '';
    let idx = 0;
    for(; idx < words.length; idx++){
      const w = words[idx];
      const test = current ? current + ' ' + w : w;
      if(measure(test, font) <= lineWidth){
        current = test;
      } else {
        lines.push(current);
        current = w;
        if(lines.length === maxLines - 1){
          idx++; // include this word as start of last line
          break;
        }
      }
    }
    if(lines.length < maxLines){
      // append remaining words into last line until overflow
      while(idx < words.length){
        const w = words[idx];
        const test = current ? current + ' ' + w : w;
        if(measure(test, font) <= lineWidth){ current = test; idx++; }
        else break;
      }
      if(current) lines.push(current);
    }
    // If there are leftover words, ellipsize the last line
    if(idx < words.length && lines.length >= 1){
      let last = lines[lines.length - 1];
      while(measure(last + '…', font) > lineWidth && last.length > 5){ last = last.slice(0, -1); }
      lines[lines.length - 1] = last + '…';
    }
    return lines.join(' ');
  }

  function relativeDate(){
    const now = new Date();
    const months = ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'];
    return `${months[now.getMonth()]} ${now.getDate()}, ${now.getFullYear()}`;
  }

  function generateFavicon(host){
    const letter = (host||'S').charAt(0).toUpperCase();
    const hue = (hashString(host||'seova') % 360);
    const bg = `hsl(${hue} 70% 55%)`;
    return `<span class="w-5 h-5 rounded-full flex items-center justify-center text-white text-[11px] font-semibold" style="background:${bg}">${letter}</span>`;
  }

  function hashString(str){
    let h=0; for(let i=0;i<str.length;i++){ h = (Math.imul(31,h) + str.charCodeAt(i))|0; } return Math.abs(h);
  }

  function ratingSnippet(){
    return `<div class="flex items-center gap-1 text-[12px] text-[#4d5156]">
      <span class="flex items-center gap-0.5 text-[#f9ab00]">${'★'.repeat(5)}</span>
      <span>5.0</span><span>·</span><span>23 reviews</span>
    </div>`;
  }

  // Bold keywords helper: wraps whole-word matches from comma-separated list in <strong>
  function escapeRegex(s){
    return s.replace(/[.*+?^${}()|[\]\\]/g, '\\$&');
  }

  function highlightKeywords(text, rawKeywords){
    if(!text) return '';
    const list = (rawKeywords||'').split(',').map(k=>k.trim()).filter(Boolean);
    if(!list.length) return escapeHtml(text);
    const pattern = list.map(escapeRegex).join('|');
    // use word boundaries; fallback to simple contains if pattern empty
    let re;
    try { re = new RegExp('\\b(' + pattern + ')\\b', 'gi'); } catch(e){ return escapeHtml(text); }
    const START = '\u0001B'; const END='\u0002';
    const withPlace = text.replace(re, (m)=> START + m + END);
    const escaped = escapeHtml(withPlace);
    return escaped.split(START).map((seg, i)=> i===0 ? seg : seg.replace(END, '</strong>').replace(/^(?:)/, '<strong>')) .join('');
  }

  async function fetchMeta(){
    const url = $('pageUrl').value.trim(); if(!url) return;
    setStatus('Fetching…'); state.fetching=true;
    try {
      const res = await fetch(`/tools/serp-preview/fetch?url=${encodeURIComponent(url)}`);
      if(!res.ok){
        const txt = await res.text().catch(()=>res.statusText || 'Fetch error');
        throw new Error(txt || `HTTP ${res.status}`);
      }
      const data = await res.json().catch(()=>({ error: 'Invalid JSON response' }));
      if(data.error){
        setStatus('Error'); notify(data.error, true);
      } else {
        if(data.title) { const el = $('serpTitle'); if(el) el.value = data.title; }
        if(data.description) { const el = $('serpDescription'); if(el) el.value = data.description; }
        updateCounters();
        render();
        setStatus('Fetched');
      }
    } catch(e){
      setStatus('Error'); notify(e.message, true);
    } finally {
      state.fetching=false;
    }
  }

  function setStatus(text){
    const badge = $('statusBadge'); if(badge) badge.textContent=text;
  }

  function notify(msg, isError){
    let box = document.createElement('div');
    box.role='alert';
    box.className=`fixed top-4 right-4 z-50 px-4 py-2 rounded shadow text-sm ${isError? 'bg-red-600 text-white':'bg-seova-green text-white'}`;
    box.textContent = msg;
    document.body.appendChild(box);
    setTimeout(()=>box.remove(), 3500);
  }

  function bindEvents(){
    const renderBtn = $('renderSerp'); if(renderBtn) renderBtn.addEventListener('click', render);
    ['serpTitle','serpDescription'].forEach(id=>{ const el = $(id); if(el) el.addEventListener('input', ()=>{ updateCounters(); render(); }); });
    const engineEl = $('engine'); if(engineEl) engineEl.addEventListener('change', e=>{ state.engine = e.target.value; toggleGoogleOptions(); render(); });
    const desktopWidthEl = $('desktopWidth'); 
    if(desktopWidthEl) {
      desktopWidthEl.addEventListener('change', e=>{ 
        state.viewport = e.target.value;
        const results = $('serpResults');
        if(results) {
          results.style.maxWidth = state.viewport === 'mobile' ? '380px' : '640px';
        }
        render();
      });
    }
    const fetchBtn = $('fetchMeta');
    const toggleFetch = $('toggleFetch');
    if(toggleFetch){
      toggleFetch.addEventListener('change', e=>{
        state.fetchEnabled = e.target.checked;
        if(fetchBtn) fetchBtn.classList.toggle('hidden', !state.fetchEnabled);
        if(state.fetchEnabled && fetchBtn) fetchBtn.focus();
      });
    }
    if(fetchBtn) fetchBtn.addEventListener('click', ()=>{ if(state.fetchEnabled) fetchMeta(); });
    const pageUrlEl = $('pageUrl'); if(pageUrlEl) pageUrlEl.addEventListener('input', ()=>{ render(); });
    const siteNameEl = $('siteName'); if(siteNameEl) siteNameEl.addEventListener('input', ()=>{ render(); });
    const boldEl = $('boldKeywords'); if(boldEl) boldEl.addEventListener('input', ()=>{ render(); });
    // Google options
    const optGoogleModern = $('optGoogleModern'); if(optGoogleModern) optGoogleModern.addEventListener('change', e=>{ state.google.modern = e.target.checked; render(); });
    const optShowDate = $('optShowDate'); if(optShowDate) optShowDate.addEventListener('change', e=>{ state.google.showDate = e.target.checked; render(); });
    const optShowRating = $('optShowRating'); if(optShowRating) optShowRating.addEventListener('change', e=>{ state.google.showRating = e.target.checked; render(); });
  }

  function toggleGoogleOptions(){
    const box = $('googleOptions');
    if(box) {
      if(state.engine==='google'){ box.classList.remove('hidden'); }
      else { box.classList.add('hidden'); }
    }
  }

  ready(()=>{
    if(!$('serpForm')) return;
    bindEvents(); 
    toggleGoogleOptions();
    updateCounters();
    render();
  });
})();