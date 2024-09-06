<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        
        <a class="nav-link">
          @include('layout/tanggal')
          
        </a>
      </li>
      
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Navbar Search -->
      {{-- <li class="nav-item">
        <a class="nav-link" data-widget="navbar-search" href="#" role="button">
          <i class="fas fa-search"></i>
        </a>
        <div class="navbar-search-block">
          <form class="form-inline">
            <div class="input-group input-group-sm">
              <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
              <div class="input-group-append">
                <button class="btn btn-navbar" type="submit">
                  <i class="fas fa-search"></i>
                </button>
                <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                  <i class="fas fa-times"></i>
                </button>
              </div>
            </div>
          </form>
        </div>
      </li>

      <!-- Messages Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-comments"></i>
          <span class="badge badge-danger navbar-badge">3</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <a href="#" class="dropdown-item">
            <!-- Message Start -->
            <div class="media">
              <img src="{{asset('AdminLTE/dist')}}/img/user1-128x128.jpg" alt="User Avatar" class="img-size-50 mr-3 img-circle">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  Brad Diesel
                  <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm">Call me whenever you can...</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
              </div>
            </div>
            <!-- Message End -->
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <!-- Message Start -->
            <div class="media">
              <img src="{{asset('AdminLTE/dist')}}/img/user8-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  John Pierce
                  <span class="float-right text-sm text-muted"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm">I got your message bro</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
              </div>
            </div>
            <!-- Message End -->
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <!-- Message Start -->
            <div class="media">
              <img src="{{asset('AdminLTE/dist')}}/img/user3-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  Nora Silvester
                  <span class="float-right text-sm text-warning"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm">The subject goes here</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
              </div>
            </div>
            <!-- Message End -->
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
        </div>
      </li> --}}
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="material-icons">settings</i>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-item dropdown-header">Pengaturan</span>
          
          <div class="dropdown-divider"></div>
          <a href="{{ url ('logout') }}" class="dropdown-item">
            <i class="fas fa-sign-out-alt"></i> Keluar
          </a>
          
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
      
    </ul>
  </nav>

  <div class="modal fade" id="modal-ubah-password">
    <div class="modal-dialog modal-sm">
        <form id="fm-ubahpassword">
            <div class="modal-content">
                <div class="modal-header bg-warning">
                    <h4 class="modal-title">Ubah Password</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                  <div class="row">
                    <div class="col-lg-12">
                      <div class="form-group">
                        <label>Tuliskan Password Lama </label>
                        <input id="pwd_lama"  class="form-control" type="password" minlength="6" required>
                        <label>Buat Password Baru </label>
                        <input id="pwd_baru"  class="form-control" type="password" minlength="6" required>
                        <label>Tulis Ulang Password baru </label>
                        <input id="repwd_baru"  class="form-control" type="password" minlength="6" required>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="modal-footer justify-content-between ">
                    <button type="button" class="col-sm-4 btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="col-sm-4 form-control btn btn-warning">Ubah</button>
                </div>
            </div>
        </form>
    </div>
</div>
<script src="{{asset('AdminLTE/plugins')}}/sweetalert2/sweetalert2.min.js"></script>
<script src="{{asset('AdminLTE/plugins')}}/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{asset('AdminLTE/plugins')}}/jquery-ui/jquery-ui.min.js"></script>
<script>
  
  $('#ubah-password').on('click', function(){
    var pasword = "{{$user->password}}";
    console.log(pasword);
  });
  $('#fm-ubahpassword').submit(function(e){
    e.preventDefault(); // prevent actual form submit
    var el = $('.btn-warning');
    el.prop('disabled', true);
    setTimeout(function(){el.prop('disabled', false); }, 3000);
    var token = "{!! csrf_token() !!}";
    var id = "{{$user->id}}";
    var pwd = $('#pwd_baru').val();
    var repwd = $('#repwd_baru').val();
    
    if(repwd == pwd){

    } else {
      Toast.fire({
        icon: 'error',
        title: 'Password baru tidak sama'
      })
      return false;
    }
    console.log(id);
    $.ajax({
      type: 'post',
      url: '{!! url("ubah-password") !!}',
      data : {
        pwd    : $('#pwd_baru').val(),
        pwdlama : $('#pwd_lama').val(),
        _token : token,
        },
      success:function(response){
          console.log(response);
          if(response.success != true){
            Toast.fire({
              icon: 'error',
              title: response.pesan
            })
          } else {
            Toast.fire({
              icon: 'success',
              title: response.pesan
            })
          }
      }, // serializes form input
    });
  });
</script>
  <!-- /.navbar -->