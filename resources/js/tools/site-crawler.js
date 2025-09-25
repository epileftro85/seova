// Vite entry: Site Crawler (CORS-limited)
(function(){
  const ready = (fn)=>document.readyState!=='loading'?fn():document.addEventListener('DOMContentLoaded',fn);
  ready(()=>{
    const btn=document.getElementById('runCrawl'); if(!btn) return;
    const urlEl=document.getElementById('crawlUrl'); const sameHostEl=document.getElementById('sameHostOnly'); const out=document.getElementById('crawlResults');
    async function fetchDocument(u){ try{ const res=await fetch(u); const text=await res.text(); return new DOMParser().parseFromString(text,'text/html'); }catch(e){ return null; } }
    btn.addEventListener('click',async()=>{
      const start=urlEl.value.trim(); if(!start){ out.innerHTML='<p class="text-sm text-red-600">Enter a start URL.</p>'; return; }
      out.innerHTML='<p class="text-sm">Crawling...</p>';
      const originHost=new URL(start).host; const visited=new Set(); const queue=[start]; const max=20; const results=[];
      while(queue.length && results.length<max){ const current=queue.shift(); if(!current||visited.has(current)) continue; visited.add(current); const doc=await fetchDocument(current); if(!doc) continue; const title=doc.querySelector('title')?.textContent?.trim()||''; results.push({url:current,title}); const links=[...doc.querySelectorAll('a[href]')].map(a=>a.getAttribute('href')).filter(h=>h&&!h.startsWith('#')).map(h=>new URL(h,current).href); for(const l of links){ if(visited.has(l)) continue; if(sameHostEl.checked && new URL(l).host!==originHost) continue; if(!queue.includes(l)) queue.push(l);} }
      out.innerHTML='<h2 class="font-semibold mb-2">Results</h2><ol class="list-decimal pl-6 space-y-1">'+results.map(r=>`<li><a class=\"text-seova-orange hover:underline\" href=\"${r.url}\" target=\"_blank\" rel=\"noopener noreferrer\">${r.title||r.url}</a></li>`).join('')+'</ol>';
    });
  });
})();
