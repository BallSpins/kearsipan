@foreach ($requests as $request)
  <p>{{ $request->subject }}</p>
  <p>{{ $request->description }}</p>
@endforeach