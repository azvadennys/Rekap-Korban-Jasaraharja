@extends('layout')

@section('content')
    <div class="row d-flex justify-content-center">
        <div class="col-md-8 col-lg-6">
            <div class="card shadow-0 border" style="background-color: #f0f2f5;">
                <div class="card-body p-4">
                    <div class="form-outline mb-4 text-center">
                        <button type="button" class="btn btn-primary text-center" data-mdb-toggle="modal"
                            data-mdb-target="#exampleModal">+ Buat Diskusi</button>
                    </div>
                    @foreach ($diskusi as $item)
                        <div class="card mb-4">
                            <div class="card-body">
                                <h4>{{ $item->nama }}</h4>
                                <p>{{ $item->pesan }}</p>

                                <div class="d-flex justify-content-between">
                                    <div class="d-flex flex-row align-items-center">

                                        <p class="small mt-2">{{ $item->created_at->diffForHumans() }}</p>
                                    </div>
                                    <div class="d-flex flex-row align-items-center">
                                        <a href="{{ route('diskusi.detail', $item->id) }}" class=""><i
                                                class="fas fa-reply me-1"></i> Reply
                                            ({{ $item->balasan->count() }})
                                        </a>
                                    </div>

                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade " id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Diskusi</h5>
                    <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('diskusi.tambah') }}" method="POST">
                        @csrf
                        <div class="form-outline border mb-2">
                            <input type="text" id="typeText" name="nama" class="form-control" required />
                            <label class="form-label" for="typeText">Nama</label>
                        </div>
                        <div class="form-outline border">
                            <textarea class="form-control" id="textAreaExample" name="pesan" rows="4" required></textarea>
                            <label class="form-label" for="textAreaExample">Pesan</label>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-mdb-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Post</button>
                </div>
                </form>
            </div>
        </div>
    </div>
@endsection
