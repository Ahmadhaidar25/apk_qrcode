@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row align-items-center">

        <div class="col">
           @if ($message = Session::get('message'))
           <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
        @endif

        <div class="card mt-2">
            <div class="card-outline">

            </div>

            <div class="card-body">

                <button type="button" class="btn btn-success mt-3" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    Add&nbsp;
                    <i class="bi bi-plus-circle"></i>
                </button>
                <table class="table mt-3">
                    <thead class="thead-dark">
                      <tr>


                        <th scope="col">Nama</th>
                        <th scope="col">No Tlp</th>
                        <th scope="col">Keluhan</th>
                        <th colspan="2">Aksi</th>


                    </tr>
                </thead>
                <tbody>

                    @foreach ($data as $x)
                    @if($x->user->id == Auth::user()->id)
                    <tr>

                        <td>{{$x->user->name}}</td>
                        <td>{{$x->no_tlp}}</td>
                        <td>{{$x->ajuan}}</td>
                        <td><a href="{{url('hapus')}}/{{$x->id}}" class="text-danger">
                            <i class="bi bi-trash"></i></a></td>
                            <td><a href="" data-bs-toggle="modal" data-bs-target="#edit-{{$x->id}}" class="text-warning"><i class="bi bi-pencil"></i></a></td>
                        </tr>
                        @endif
                        @endforeach

                    </tbody>

                </table>

            </div>
        </div>

    </div>
    <div class="col">
       <div class="card ">
          <div class="card-header bg-success text-white">
            Scane Qr Code
        </div>
        <div class="card-body">
          <center>
              <video id="preview" width="300" height="400"></video>
          </center>
          <input type="text" name="" class="form-control" id="qrcode" readonly>
      </div>
  </div>
</div>

</div>


</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Form Ajuan</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <form action="{{url('ajuan')}}" method="post">
        <div class="modal-body">
         @csrf


         <div class="mb-3">
            <label for="recipient-name" class="col-form-label">No Tlp</label>
            <input type="text" class="form-control" name="no_tlp" 
            id="no_tlp" required>
        </div>

        <div class="mb-3">
            <label for="message-text" class="col-form-label">Ajuan</label>
            <textarea class="form-control" name="ajuan" id="ajuan" required></textarea>
        </div>

    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-success">Send&nbsp;<i class="bi bi-send"></i></button>
    </div>
</form>

</div>
</div>
</div>

@foreach ($data as $e)
<div class="modal fade" id="edit-{{$e->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-success">
        <h5 class="modal-title text-white" id="exampleModalLabel">Edit</h5>
        <button type="button" class="btn-close text-white" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <form action="{{url('update')}}/{{$e->id}}" method="post">
        <div class="modal-body">
         @csrf


         <div class="mb-3">
            <label for="recipient-name" class="col-form-label">No Tlp</label>
            <input type="text" class="form-control" name="no_tlp" 
            id="no_tlp" value="{{$e->no_tlp}}">
        </div>

        <div class="mb-3">
            <label for="message-text" class="col-form-label">Ajuan</label>
            <textarea class="form-control" name="ajuan" id="ajuan">{{$e->ajuan}}</textarea>
        </div>

    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Ajukan</button>
    </div>
</form>

</div>
</div>
</div>

@endforeach

<script type="text/javascript">
    let scanner = new Instascan.Scanner({video: document.getElementById('preview')});
    scanner.addListener('scan', function(content){
     //alert(content);
     $("#qrcode").val(content);
 });

    Instascan.Camera.getCameras().then(function (cameras){
        if (cameras.length > 0) {
           scanner.start(cameras[0]);
       }else{

        console.error('No Camera Found');
    }
}).catch(function(e){
    console.error(e);
}); 


</script>


@endsection
