@extends('layouts.app')

@section('content')
      <!-- contact -->
      <div class="contact">
         <div class="container">
            <div class="row ">
               <div class="col-md-12">
                  <div class="titlepage text_align_center">
                     <h2>Ingrese sus datos de <span class="blue_light">Acceso</span></h2>
                  </div>
               </div>
               <div class="col-md-10 offset-md-1">
                  <!-- IMPORTANTE: action apunta a la ruta de Laravel -->
                  <form id="request" class="main_form" action="{{ route('login') }}" method="POST">
                     @csrf
                     <div class="row">
                        <div class="col-md-12 ">
                           <input class="login" placeholder="Usuario" type="text" name="username" id="username" required>
                        </div>
                        <div class="col-md-12">
                           <input class="login" placeholder="Contraseña" type="password" name="password" id="password" required>                          
                        </div>
                        <div class="col-md-12">
                           <button class="send_btn" type="submit">Ingresar</button>
                        </div>
                     </div>
                     
                     @if ($errors->any())
                        <div style="color: red; margin-top: 15px; text-align: center;">
                           {{ $errors->first() }}
                        </div>
                     @endif
                  </form>
               </div>
            </div>
         </div>
      </div>
      <!-- contact -->
@endsection