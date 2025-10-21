// Vite entry: Keyword Explorer
(function(){
  const ready = (fn)=>document.readyState!=='loading'?fn():document.addEventListener('DOMContentLoaded',fn);
  ready(()=>{
    const btn = document.getElementById('runKeyword');
    if(!btn) return;
    const seedsEl = document.getElementById('seeds');
    const results = document.getElementById('keywordResults');
    const mutate = (text) => [text, text + ' tool', text + ' software', 'best ' + text, text + ' checklist'];
    btn.addEventListener('click', () => {
      const raw = (seedsEl.value || '').split(/\n+/).map(s => s.trim()).filter(Boolean).slice(0,50);
      if(!raw.length){
        results.innerHTML = '<p class="text-sm text-red-600">Add at least one seed keyword.</p>';
        return;
      }
      const ideas = Array.from(new Set(raw.flatMap(mutate)));
      results.innerHTML = '<h2 class="font-semibold">Generated Ideas</h2>' + '<ul class="list-disc pl-6 space-y-1">' + ideas.map(k => `<li>${k}</li>`).join('') + '</ul>';
    });
  });
})();
