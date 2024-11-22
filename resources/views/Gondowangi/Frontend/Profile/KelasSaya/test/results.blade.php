@extends('gondowangi.frontend.layout.main')

@section('content')
<div class="container">
    <h2>Hasil Test</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Pertanyaan</th>
                <th>Jawaban Anda</th>
                <th>Jawaban Benar</th>
                <th>Status</th>
                <th>Penjelasan</th>
            </tr>
        </thead>
        <tbody>
            @foreach($results as $result)
            <tr>
                <td>{{ $result['question'] }}</td>
                <td>{{ $result['user_answer'] ?? 'Tidak dijawab' }}</td>
                <td>{{ $result['correct_answer'] }}</td>
                <td>
                    @if($result['is_correct'])
                        <span class="text-success">Benar</span>
                    @else
                        <span class="text-danger">Salah</span>
                    @endif
                </td>
                <td>{{ $result['explanation'] }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
