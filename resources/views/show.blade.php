@extends('layout')

@section('content')
    <div class="row d-flex justify-content-center">
        <div class="col-md-12 col-lg-10 col-xl-8">
            <div class="card">
                <div class="card-body p-4">
                    <div class="form-outline mb-4 ">
                        <a href="{{ route('/') }}" type="button" class="btn btn-info text-center">Kembali</a>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="d-flex flex-start">
                                <div class="flex-grow-1 flex-shrink-1">
                                    <div>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <p class="mb-1">
                                                <b>{{ $diskusi->nama }}</b> <span class="small"> -
                                                    {{ $diskusi->created_at->diffForHumans() }}</span>
                                            </p>
                                            <a href="#!"><i class="fas fa-reply fa-xs"></i><span class="small"
                                                    data-mdb-toggle="modal" data-mdb-target="#exampleModal">
                                                    reply</span></a>
                                        </div>
                                        <p class="small mb-0">
                                            It is a long established fact that a reader will be distracted by
                                            the readable content of a page.
                                        </p>
                                    </div>
                                    @foreach ($diskusi->balasan as $item)
                                        <div class="d-flex flex-start mt-4 ">
                                            <div class="flex-grow-1 flex-shrink-1 mx-5">
                                                <div>
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <p class="mb-1">
                                                            <b>{{ $item->nama }}</b><span class="small"> -
                                                                {{ $item->created_at->diffForHumans() }}</span>
                                                        </p>
                                                    </div>
                                                    <p class="small mb-0">
                                                        {{ $item->pesan }}
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade " id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Komentar</h5>
                    <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('balasan.tambah') }}" method="POST">
                        @csrf
                        <div class="form-outline border mb-2">
                            <input type="text" id="typeText" name="nama" class="form-control" required />
                            <label class="form-label" for="typeText">Nama</label>
                        </div>
                        <div class="form-outline border">
                            <textarea class="form-control" id="textAreaExample" name="pesan" rows="4" required></textarea>
                            <label class="form-label" for="textAreaExample">Pesan</label>
                        </div>
                        <input type="text" name="diskusi_id" value="{{ $diskusi->id }}" class="form-control" required
                            hidden />
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
