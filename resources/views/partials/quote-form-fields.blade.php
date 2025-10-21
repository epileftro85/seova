@php($p = isset($idPrefix) ? $idPrefix : '')
<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
    <div>
        <label for="{{$p}}name" class="block text-sm font-medium text-gray-700">Full Name <span aria-hidden="true">*</span></label>
        <input type="text" id="{{$p}}name" name="name" required autocomplete="name" class="mt-2 w-full border rounded-md border-gray-300 focus:border-seova-orange focus:ring-seova-orange" value="{{ old('name') }}">
        @error('name')<p class="mt-2 text-sm text-red-600" role="alert">{{ $message }}</p>@enderror
    </div>
    <div>
        <label for="{{$p}}email" class="block text-sm font-medium text-gray-700">Email <span aria-hidden="true">*</span></label>
        <input type="email" id="{{$p}}email" name="email" required autocomplete="email" class="mt-2 w-full border rounded-md border-gray-300 focus:border-seova-orange focus:ring-seova-orange" value="{{ old('email') }}">
        @error('email')<p class="mt-2 text-sm text-red-600" role="alert">{{ $message }}</p>@enderror
    </div>
    <div class="md:col-span-2">
        <label for="{{$p}}website" class="block text-sm font-medium text-gray-700">Website URL</label>
        <input type="url" id="{{$p}}website" name="website" placeholder="https://example.com" inputmode="url" autocomplete="url" class="mt-2 w-full border rounded-md border-gray-300 focus:border-seova-orange focus:ring-seova-orange" value="{{ old('website') }}">
        @error('website')<p class="mt-2 text-sm text-red-600" role="alert">{{ $message }}</p>@enderror
    </div>
    <div>
        <label for="{{$p}}budget" class="block text-sm font-medium text-gray-700">Monthly Budget (USD) <span aria-hidden="true">*</span></label>
        <select id="{{$p}}budget" name="budget" required class="mt-2 w-full border rounded-md border-gray-300 bg-white focus:border-seova-orange focus:ring-seova-orange">
            <option value="" disabled selected>Select a range</option>
            <option value="under-1000" @selected(old('budget')==='under-1000')>< $1,000</option>
            <option value="1000-3000" @selected(old('budget')==='1000-3000')>$1,000 – $3,000</option>
            <option value="3000-5000" @selected(old('budget')==='3000-5000')>$3,000 – $5,000</option>
            <option value="5000-10000" @selected(old('budget')==='5000-10000')>$5,000 – $10,000</option>
            <option value="10000-plus" @selected(old('budget')==='10000-plus')>$10,000+</option>
            <option value="not-sure" @selected(old('budget')==='not-sure')>Not sure yet</option>
        </select>
        @error('budget')<p class="mt-2 text-sm text-red-600" role="alert">{{ $message }}</p>@enderror
    </div>
    <div>
        <label for="{{$p}}goal" class="block text-sm font-medium text-gray-700">Primary Goal <span aria-hidden="true">*</span></label>
        <select id="{{$p}}goal" name="goal" required class="mt-2 w-full border rounded-md border-gray-300 bg-white focus:border-seova-orange focus:ring-seova-orange">
            <option value="" disabled selected>Select a goal</option>
            <option value="more-traffic" @selected(old('goal')==='more-traffic')>Grow organic traffic</option>
            <option value="more-leads" @selected(old('goal')==='more-leads')>Increase leads/sales</option>
            <option value="site-health" @selected(old('goal')==='site-health')>Fix technical issues</option>
            <option value="keyword-strategy" @selected(old('goal')==='keyword-strategy')>Improve keyword strategy</option>
            <option value="reporting" @selected(old('goal')==='reporting')>Better reporting & ROI</option>
        </select>
        @error('goal')<p class="mt-2 text-sm text-red-600" role="alert">{{ $message }}</p>@enderror
    </div>
    <div class="md:col-span-2">
        <label for="{{$p}}message" class="block text-sm font-medium text-gray-700">Tell us about your business</label>
        <textarea id="{{$p}}message" name="message" rows="5" class="mt-2 w-full border rounded-md border-gray-300 focus:border-seova-orange focus:ring-seova-orange" placeholder="Current challenges, target audience, timelines…">{{ old('message') }}</textarea>
        @error('message')<p class="mt-2 text-sm text-red-600" role="alert">{{ $message }}</p>@enderror
    </div>
</div>
<div class="mt-6">
    <label class="inline-flex items-start gap-2">
        <input type="checkbox" name="consent" id="{{$p}}consent" required class="mt-1 rounded border-gray-300 text-seova-orange focus:ring-seova-orange" @checked(old('consent'))>
        <span class="text-sm text-gray-700">I agree to be contacted and accept the <a href="#privacy" class="text-seova-orange hover:text-seova-orange underline">privacy policy</a>. <span aria-hidden="true">*</span></span>
    </label>
    @error('consent')<p class="mt-2 text-sm text-red-600" role="alert">{{ $message }}</p>@enderror
</div>
<div class="hidden" aria-hidden="true">
    <label for="{{$p}}company">Company</label>
    <input type="text" id="{{$p}}company" name="company" tabindex="-1" autocomplete="off">
 </div>
<div class="mt-8 flex justify-center">
    <button type="submit" class="bg-blue-600 text-white px-6 py-3 rounded-lg font-semibold hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:ring-offset-2">Get My Quote</button>
</div>
