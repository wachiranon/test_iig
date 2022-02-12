
<div id="app">
    <nav class="navbar navbar-expand-md navbar-light shadow-sm  blue_bg">
        <div class="container">
            <a class="navbar-brand  text-white" href="{{ url('/') }}">
                Test
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav mr-auto">

                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ml-auto">
                    <!-- Authentication Links -->
                    @if(!isset($user))
                        <li class="nav-item">
                            <a class="nav-link  text-white" href="{{ route('login') }}">{{ __('เข้าสู่ระบบ') }}</a>
                        </li>
                        @if(Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link  text-white" href="{{ route('register') }}">{{ __('สมัครสมาชิก') }}</a>
                            </li>
                        @endif
                    @else
                        <li class="nav-item dropdown">
                            <div class="row">
                                <img src="{{ asset('file/'.$user->profile_img) }}" width="30" height="30" class="d-inline-block align-top" alt="">
                                <a class=" text-white" style="cursor: pointer; margin-left:5px;" data-toggle="modal" data-target="#userModal">
                                    {{ $user->fname }}
                                </a>
                            </div>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>

    {{-- Modal --}}
    <div class="modal modal-width fade" id="userModal" tabindex="-1" role="dialog" aria-labelledby="userModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="userModalLabel">ตัวเลือก <span class="text-sucess" style="font-size:16px">option</span></h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <center>
                                <form action="{{route('login')}}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <button type="submit" class="btn btn-secondary shadow-sm m-1" style="min-width:150px;">Log Out</button>
                                </form>
                            </center>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>