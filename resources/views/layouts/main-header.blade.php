<!-- main-header opened -->
			<div class="main-header sticky side-header nav nav-item">
				<div class="container-fluid">
					<div class="main-header-left ">
						<div class="responsive-logo">
							<a href="{{ url('/' . $page='index') }}"><img src="{{URL::asset('assets/img/brand/logo.png')}}" class="logo-1" alt="logo"></a>
							<a href="{{ url('/' . $page='index') }}"><img src="{{URL::asset('assets/img/brand/logo-white.png')}}" class="dark-logo-1" alt="logo"></a>
							<a href="{{ url('/' . $page='index') }}"><img src="{{URL::asset('assets/img/brand/favicon1.png')}}" class="logo-2" alt="logo"></a>
							<a href="{{ url('/' . $page='index') }}"><img src="{{URL::asset('assets/img/brand/favicon1.png')}}" class="dark-logo-2" alt="logo"></a>
						</div>
						<div class="app-sidebar__toggle" data-toggle="sidebar">
							<a class="open-toggle" href="#"><i class="header-icon fe fe-align-left" ></i></a>
							<a class="close-toggle" href="#"><i class="header-icons fe fe-x"></i></a>
						</div>
						
					</div>
					<div class="main-header-right">
						
						<div class="nav nav-item  navbar-nav-right ml-auto">
							 <!-- <div class="nav-link" id="bs-example-navbar-collapse-1">
								<form class="navbar-form" role="search">
									<div class="input-group">
										<input type="text" class="form-control" placeholder="Search">
										<span class="input-group-btn">
											<button type="reset" class="btn btn-default">
												<i class="fas fa-times"></i>
											</button>
											<button type="submit" class="btn btn-default nav-link resp-btn">
												<svg xmlns="http://www.w3.org/2000/svg" class="header-icon-svgs" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
											</button>
										</span>
									</div>
								</form>
							</div> -->
							
							<div class="dropdown nav-item main-header-notification">
								<a class="new nav-link" href="#">
								<svg xmlns="http://www.w3.org/2000/svg" class="header-icon-svgs" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-bell"><path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path><path d="M13.73 21a2 2 0 0 1-3.46 0"></path></svg><span class=" pulse"></span></a>
								<div class="dropdown-menu">
									<div class="menu-header-content bg-primary text-right">
										<div class="d-flex">
											<h6 class="dropdown-title mb-1 tx-15 text-white font-weight-semibold">{{ trans('message.Notifications') }}</h6>
											<a href="{{route('markAsRead')}}" class="badge badge-pill badge-warning mr-auto my-auto float-left">  {{ trans('message.Must_read_all') }}</a>
										</div>
										<p class="dropdown-title-text subtext mb-0 text-white op-6 pb-0 tx-12 " id="notifications_count">{{ trans('message.Number_of_unread_notifications:') }} {{ auth()->user()->unreadNotifications->count() }}</p>
									</div>
									<div class="main-notification-list Notification-scroll" id="unreadNotifications">
    @foreach (Auth::user()->unreadNotifications->take(3) as $notification)
        <a class="d-flex p-3 border-bottom" href="{{ route('invoices.show', $notification->data['id']) }}">
            <div class="notifyimg bg-pink">
                <i class="la la-file-alt text-white"></i>
            </div>
            <div class="mr-3">
                <h5 class="notification-label mb-1">{{ $notification->data['title'] . ' ' . $notification->data['user'] }}</h5>
                <div class="notification-subtext">{{ $notification->created_at }}</div>
            </div>
            <div class="mr-auto">
                <i class="las la-angle-left text-left text-muted"></i>
            </div>
        </a>
    @endforeach
</div>

									<div class="dropdown-footer">
										<a href="{{ route('invoices.index') }}">{{ trans('message.VIEW_ALL:') }} </a>
									</div>
								</div>
							</div>
							
							<div class="dropdown main-profile-menu nav nav-item nav-link">
								<a class="profile-user d-flex" href=""><img alt="" src="{{URL::asset('assets/img/user.png')}}"></a>
								<div class="dropdown-menu">
									<div class="main-header-profile bg-primary p-3">
										<div class="d-flex wd-100p">
											<div class="main-img-user"><img alt="" src="{{URL::asset('assets/img/user.png')}}" class=""></div>
											<div class="mr-3 my-auto">
												<h6>{{auth()->user()->name}}</h6><span>{{auth()->user()->email}}</span>
											</div>
										</div>
									</div>
									<a class="dropdown-item" href="{{ route('logout') }}"
									onclick="event.preventDefault();document.getElementById('logout-form').submit();"><i
									class="bx bx-log-out"></i> {{ trans('message.Log_out') }}</a>
									<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
									@csrf
									</form>
   
								</div>
							</div>
							
						</div>
					</div>
				</div>
			</div>
