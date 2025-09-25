// Vite entry: SERP Preview
(function(){
  const ready = (fn)=>document.readyState!=='loading'?fn():document.addEventListener('DOMContentLoaded',fn);
  ready(()=>{
    const btn=document.getElementById('renderSerp'); if(!btn) return;
    const tEl=document.getElementById('serpTitle'); const dEl=document.getElementById('serpDescription'); const out=document.getElementById('serpResults');
    const truncate=(s,m)=>s.length>m? s.slice(0,m-1)+'…':s;
    btn.addEventListener('click',()=>{
      const title=truncate(tEl.value.trim(),65); const desc=truncate(dEl.value.trim(),160); const now=new Date();
      out.innerHTML=`<div class=\"border rounded-lg p-5 bg-white shadow-sm\"><p class=\"text-xs text-gray-500\">Preview (simulation)</p><a href=\"#\" class=\"block text-[#1a0dab] text-xl leading-snug hover:underline visited:text-purple-700\">${title||'Title Example – Brand'}</a><div class=\"text-[#006621] text-sm mb-1\">seova.pro › tools <span class=\"text-gray-400\">${now.getFullYear()}</span></div><div class=\"text-sm text-gray-700\">${desc||'Meta description preview will appear here. Keep it compelling, specific, and user-focused.'}</div></div>`;
    });
  });
})();
