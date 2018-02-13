@extends('main')

@section('title','Contact');

@section('contact')
  active
@endsection

@section('content')
      <div class="row">
        <div class="col-md-12">
          <h1>연락하기</h1>
          <hr>
          <form action="{{'contact/send'}}" method="post">
          {{ csrf_field()}}
            <div class="form-group">
              <label name='eamil'>이메일</label>
              <input name="email" class="form-control">
            </div>

            <div class="form-group">
              <label name='subject'>제목</label>
              <input name="subject" class="form-control">
            </div>

            <div class="form-group">
              <label name='message'>내용</label>
              <input type="textarea" name="message" class="form-control">
            </div>
            <input type="submit" value="SEND" class="btn btn-success">
          </form>
        </div>
      </div>
 @endsection