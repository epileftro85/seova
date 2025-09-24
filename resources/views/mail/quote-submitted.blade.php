@php($d = $data)
<div>
    <p><strong>New quote request</strong> (ref: {{ $reference }})</p>
    <ul>
        <li><strong>Name:</strong> {{ $d['name'] ?? '' }}</li>
        <li><strong>Email:</strong> {{ $d['email'] ?? '' }}</li>
        <li><strong>Website:</strong> {{ $d['website'] ?? '' }}</li>
        <li><strong>Budget:</strong> {{ $d['budget'] ?? '' }}</li>
        <li><strong>Goal:</strong> {{ $d['goal'] ?? '' }}</li>
    </ul>
    <p><strong>Message:</strong></p>
    <pre style="white-space: pre-wrap; font-family: ui-monospace, Menlo, Monaco, Consolas, 'Liberation Mono', 'Courier New', monospace;">{{ $d['message'] ?? '' }}</pre>
</div>
