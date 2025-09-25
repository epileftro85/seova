// Vite entry: Meta Tag Analyzer
(function(){
  const ready = (fn)=>document.readyState!=='loading'?fn():document.addEventListener('DOMContentLoaded',fn);
  ready(()=>{
    const btn = document.getElementById('analyzeMeta');
    if(!btn) return;
    const tEl = document.getElementById('metaTitle');
    const dEl = document.getElementById('metaDescription');
    const out = document.getElementById('metaResults');
    function scoreTitle(t){ if(!t) return {s:'error',m:'Missing title'}; const l=t.length; if(l<30) return {s:'warn',m:`Short (${l} chars)`}; if(l>65) return {s:'warn',m:`Long (${l} chars)`}; return {s:'ok',m:`Good length (${l})`}; }
    function scoreDescription(d){ if(!d) return {s:'error',m:'Missing description'}; const l=d.length; if(l<110) return {s:'warn',m:`Short (${l} chars)`}; if(l>170) return {s:'warn',m:`Long (${l} chars)`}; return {s:'ok',m:`Good length (${l})`}; }
    btn.addEventListener('click',()=>{
      const title=tEl.value.trim(); const desc=dEl.value.trim();
      const t=scoreTitle(title); const d=scoreDescription(desc);
      const badge=(o)=>{const c={ok:'bg-green-100 text-green-700',warn:'bg-yellow-100 text-yellow-700',error:'bg-red-100 text-red-700'};return `<span class="px-2 py-1 rounded text-xs font-medium ${c[o.s]}">${o.s.toUpperCase()}</span> ${o.m}`;};
      out.innerHTML=`<div class=\"space-y-4\"><div><h2 class=\"font-semibold mb-1\">Title Result</h2><p class=\"text-sm\">${badge(t)}</p></div><div><h2 class=\"font-semibold mb-1\">Description Result</h2><p class=\"text-sm\">${badge(d)}</p></div></div>`;
    });
  });
})();
