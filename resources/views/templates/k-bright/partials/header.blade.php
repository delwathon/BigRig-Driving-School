@php
$pages = App\Models\Page::where('tempname',$activeTemplate)->where('is_default',App\Constants\Status::NO)->get();
$socialIcon  = getContent('social_icon.element', false, null, true);

@endphp
{{-- <div class="topbar">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6 sol-sm-12">
                <div class="email">
                    <figure class="mb-0 emailicon">
                        <img src="{{asset($activeTemplateTrue . 'images/header-emailicon.png')}}" alt="" class="img-fluid">
                    </figure>
                    <a href="mailto:{{$general->email_from }}" class="mb-0 text-size-16 text-white">{{$general->email_from }}</a>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 sol-sm-12 d-md-block d-none">
                <div class="mb-0 social-icons">
                    <ul class="mb-0 list-unstyled">

                        <li>Follow us on:</li>
                        @foreach ($socialIcon as $social)
                        <li>
                            <a href="{{ @$social->data_values->url }}"> {!!$social->data_values->social_icon!!} </a>
                        </li>
                        @endforeach
                       
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>


<header class="header">
    <div class="container">
        <nav class="navbar position-relative navbar-expand-lg navbar-light">
            <a class="navbar-brand" href="{{route('home')}}"><figure class="mb-0"><img style="width: 233px; height:57px; object-fit:cover" src="{{ getImage(getFilePath('logoIcon') . '/logo.png') }}" alt="" class="img-fluid"></figure></a>
            <button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" 
            aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            <span class="navbar-toggler-icon"></span>
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto">

                    <li  class="nav-item {{ request()->routeIs('home') ? 'active' : '' }}"><a  class="nav-link"href="{{ route('home') }}">@lang('Home')</a></li>
                    @foreach ($pages as $k => $data)
                    <li class="nav-item {{ request()->routeIs(route('pages', [$data->slug])) ? 'active' : '' }}"><a class="nav-link" href="{{ route('pages', [$data->slug]) }}">{{ __($data->name) }}</a></li>
                    @endforeach
                    <li  class="nav-item {{ request()->routeIs('contact') ? 'active' : '' }}"><a class="nav-link" href="{{ route('contact') }}">@lang('Contact')</a></li>

                    @auth
                    <li class="nav-item {{ request()->routeIs('user.home') ? 'active' : '' }}">
                         <a class="nav-link" href="{{ route('user.home') }}"><i class="las la-tachometer-alt"></i> @lang('Dashboard')</a>
                    </li>
                    <li class="nav-item" >
                         <a class="nav-link" href="{{ route('user.logout') }}"><i class="las la-sign-out-alt"></i> @lang('Logout')
                    </a>
                    </li>
                   
                    @else
                    <li class="nav-item {{ request()->routeIs('user.login') ? 'active' : '' }}">
                         <a  class="nav-link sign" href="{{ route('user.login') }}"><i class="las la-sign-in-alt"></i> @lang('Login')
                            </a>
                    </li>

                   
                    @if ($general->registration)
                    <li class="nav-item">
                         <a  class="nav-link signup {{ request()->routeIs('user.register') ? 'active' : '' }}" href="{{ route('user.register') }}"><i class="las la-user-plus"></i> @lang('Registration')</a>

                    </li>
                    @endif
                    @endauth
                </ul>
            </div>
        </nav>
    </div>
</header> --}}



<div class="relative h-[330px]  md:h-[600px] lg:h-[850px]">
    <!-- Navbar -->
    <nav class="bg-transparent p-4">
        <div class="container mx-auto flex items-center justify-between">

            <!-- Logo on the left -->
            <a href="{{route('home')}}" class="">
                <img src="{{ getImage(getFilePath('logoIcon') . '/logo.png') }}" alt="" class="h-[40px] md:h-[50px] md:w-[90px] lg:h-[70px] lg:w-[120px]">
            </a>

            <!-- Navbar Links for large screens, hidden on small screens -->
         
            <div class="hidden md:flex items-center md:space-x-[25px] lg:space-x-[50px]">
                @foreach ($pages as $k => $data)
                    <a href="{{ route('pages', [$data->slug]) }}" class="text-white md:text-[14px] lg:text-[18px] hover:text-white hover:text-opacity-30">{{ __($data->name) }}</a>

                @endforeach
                {{-- <a href="./html/Pricing.html" class="text-white md:text-[14px] lg:text-[18px] hover:text-white hover:text-opacity-30">Pricing</a>
                <a href="#" class="text-white md:text-[14px] lg:text-[18px] hover:text-white hover:text-opacity-30">Testimonials</a>
                <a href="./html/Contact.html" class="text-white md:text-[14px] lg:text-[18px] hover:text-white hover:text-opacity-30">Contact</a> --}}
            </div>

            <!-- Get Started button for large screens -->
            <div class="hidden md:flex">
                   @auth
                   <button class="bg-[#FF0000] text-white md:px-8 md:py-2 lg:px-10 lg:py-3 rounded-full md:text-[10px] lg:text-[14px] font-bold hover:bg-opacity-55 ">

                   <a href="{{ route('user.home') }}" class="mx-3">Dashboard</a>
                   </button>
                   <button class="bg-[#FF0000] text-white md:px-8 md:py-2 lg:px-10 lg:py-3 rounded-full md:text-[10px] lg:text-[14px] font-bold hover:bg-opacity-55 ">

                   <a href="{{ route('user.logout') }}" class="mx-3">Logout</a>
                   </button>
                   @else
                   @if ($general->registration)
                   <button class="bg-[#FF0000] text-white md:px-8 md:py-2 lg:px-10 lg:py-3 rounded-full md:text-[10px] lg:text-[14px] font-bold hover:bg-opacity-55 ">

                   <a href="{{ route('user.register') }}" class="mx-3">Get Started</a>
                   </button>
                   @endif
                   <button class="bg-[#FF0000] text-white md:px-8 md:py-2 lg:px-10 lg:py-3 rounded-full md:text-[10px] lg:text-[14px] font-bold hover:bg-opacity-55 ">

                   <a href="{{ route('user.login') }}" class="mx-3">Login</a>
                       </button>
                   @endauth
                 
                    
            </div>

            <!-- Toggler button for mobile screens -->
            <div class="md:hidden flex items-center">
                <button id="navbar-toggler" class="text-white focus:outline-none">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
                    </svg>
                </button>
            </div>
        </div>

        <!-- Mobile Menu, positioned over other content (absolute positioning) -->
        <div id="navbar-menu" class="hidden">
            <div  class="absolute inset-x-0 top-12 bg-gray-900 bg-opacity-50 text-white p-4  md:hidden flex flex-col space-y-4 z-50">
                <a href="./html/Aboutus.html" class="text-white text-[15px] hover:text-white hover:text-opacity-30">About</a>
                <a href="./html/Pricing.html" class="text-white text-[15px] hover:text-white hover:text-opacity-30">Pricing</a>
                <a href="#" class="text-white text-[15px] hover:text-white hover:text-opacity-30">Testimonials</a>
                <a href="./html/Contact.html" class="text-white text-[15px] hover:text-white hover:text-opacity-30">Contact</a>
                <button class="bg-[#FF0000] text-white px-10 py-3 rounded-full text-[14px] font-bold hover:bg-opacity-55 ">
                    <a href="./html/Registration.html" class="text-red-500">Get Started</a>
                </button>
            </div>
        </div>
    </nav>

    <!-- end navbar -->


    <div class="flex place-content-center px-6 mt-2 md:mt-28 lg:mt-[250px]">
        <div>
            <h4 class="text-[18px] md:text-[28px] lg:text-[36px] font-serif font-medium text-white text-center">Master the Road Ahead With Big Rig Driving School</h4>
            <div class="flex place-content-center">
                <p class="text-[8px] text-white text-opacity-40 text-center my-3  md:w-[590px] md:text-[14px] lg:w-[690px] lg:text-[16px] ">Join our dedicated team and get hand-on experience  with truck, forklift, school
                    bus and regular vehicles. Register with us and embark on a journey towards a 
                brighter future behind the wheel.</p>
            </div>
            <div class="flex place-content-center">
                <button class="bg-[#FF0000] text-white px-10 py-2 lg:py-3 rounded-full text-[10px] lg:text-[14px] font-bold hover:bg-opacity-55">
                    <a href="./html/Registration.html">Get Started</a>
                </button>
            </div>
        </div>
    </div>

    <div class="absolute top-0 -z-10 w-full h-auto ">
        <img src="./asset/navbarimg.png" alt="" class="w-full h-auto lg:h-[820px]">
    </div>
</div>


<div class="py-8 px-4 md:px-8 lg:px-24">
    <div class="flex place-content-center">
        <div>
            <h4 class="font-serif text-[18px] md:text-[20px] lg:text-[32px] font-bold text-[#333333] tracking-wider">What we offer?</h4>
            <hr class="border-[3px] border-[#FF0000] w-20 lg:w-36 mt-1">
        </div>
    </div>


    <div>
        <div class="slider-container relative w-full max-w-screen-xl mx-auto mt-10">
            <div class="slider flex w-full  lg:gap-6">
                <!-- Slider Item 1 -->
                <div class="slider-item flex-none w-full sm:w-1/2  lg:w-[400px]  rounded-[15px] border-[1px] border-[#808080] h-fit pt-4 pb-8 flex place-content-center">
                    <div class="mx-4 md:mx-6 lg:mx-0">
                        <h4 class="text-[#333333] font-bold  text-[24px]">Truck Driving </h4>
                        <img src="./asset/truck1.png" alt="" class="my-4">
                        <p class="text-[#333333] font-bold  text-[16px] mb-3">Features</p>
                        <ul class="list-disc list-inside ml-2 space-y-2">
                            <li class=" text-[12px] font-normal text-[#333333]">Comprehensive training for various types of forklift.</li>
                            <li class=" text-[12px] font-normal text-[#333333]">Hands-on experience .</li>
                            <li class=" text-[12px] font-normal text-[#333333]">Beginners and professional friendly</li>
                            <li class=" text-[12px] font-normal text-[#333333]">Driving techniques and safety measures</li>
                            <li class=" text-[12px] font-normal text-[#333333]">Certificate upon completion</li>
                        </ul>
                        <p class="text-[#333333] font-bold text-[16px] mt-4">Requirements</p>
                        <div class="pb-6">
                            <div class="flex h-fit mt-3 gap-3">
                                <i class='bx bx-check-circle text-[20px] text-[#333333] font-bold h-fit my-auto'></i>
                                <p class=" text-[12px] font-normal text-[#333333] h-fit my-auto">Valid driver’s licence</p>
                            </div>
                            <div class="flex h-fit mt-3 gap-3">
                                <i class='bx bx-check-circle text-[20px] text-[#333333] font-bold h-fit my-auto'></i>
                                <p class=" text-[12px] font-normal text-[#333333] h-fit my-auto">Driving experience</p>
                            </div>
                            <div class="flex h-fit mt-3 gap-3">
                                <i class='bx bx-check-circle text-[20px] text-[#333333] font-bold h-fit my-auto'></i>
                                <p class=" text-[12px] font-normal text-[#333333] h-fit my-auto">Must be above 18 years old</p>
                            </div>
                            <div class="flex h-fit mt-3 gap-3">
                                <i class='bx bx-check-circle text-[20px] text-[#333333] font-bold h-fit my-auto'></i>
                                <p class=" text-[12px] font-normal text-[#333333] h-fit my-auto">Ability to pass physical and drug screening.</p>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- Slider Item 2 -->
                <div class="slider-item flex-none w-full sm:w-1/2  lg:w-[400px]  rounded-[15px] border-[1px] border-[#808080] h-fit pt-4 pb-8 flex place-content-center">
                    <div class="mx-4 md:mx-6 lg:mx-0">
                        <h4 class="text-[#333333] font-bold  text-[24px]">Forklift Driving </h4>
                        <img src="./asset/fork1.png" alt="" class="my-4">
                        <p class="text-[#333333] font-bold  text-[16px] mb-3">Features</p>
                        <ul class="list-disc list-inside ml-2 space-y-2">
                            <li class=" text-[12px] font-normal text-[#333333]">Comprehensive training for various types of forklift.</li>
                            <li class=" text-[12px] font-normal text-[#333333]">Hands-on experience .</li>
                            <li class=" text-[12px] font-normal text-[#333333]">Beginners and professional friendly</li>
                            <li class=" text-[12px] font-normal text-[#333333]">Driving techniques and safety measures</li>
                            <li class=" text-[12px] font-normal text-[#333333]">Certificate upon completion</li>
                        </ul>
                        <p class="text-[#333333] font-bold text-[16px] mt-4">Requirements</p>
                        <div class="pb-6">
                            <div class="flex h-fit mt-3 gap-3">
                                <i class='bx bx-check-circle text-[20px] text-[#333333] font-bold h-fit my-auto'></i>
                                <p class=" text-[12px] font-normal text-[#333333] h-fit my-auto">Valid driver’s licence</p>
                            </div>
                            <div class="flex h-fit mt-3 gap-3">
                                <i class='bx bx-check-circle text-[20px] text-[#333333] font-bold h-fit my-auto'></i>
                                <p class=" text-[12px] font-normal text-[#333333] h-fit my-auto">Driving experience</p>
                            </div>
                            <div class="flex h-fit mt-3 gap-3">
                                <i class='bx bx-check-circle text-[20px] text-[#333333] font-bold h-fit my-auto'></i>
                                <p class=" text-[12px] font-normal text-[#333333] h-fit my-auto">Must be above 18 years old</p>
                            </div>
                            <div class="flex h-fit mt-3 gap-3">
                                <i class='bx bx-check-circle text-[20px] text-[#333333] font-bold h-fit my-auto'></i>
                                <p class=" text-[12px] font-normal text-[#333333] h-fit my-auto">Ability to pass physical and drug screening.</p>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- Slider Item 3 -->
                <div class="slider-item flex-none w-full sm:w-1/2  lg:w-[400px]  rounded-[15px] border-[1px] border-[#808080] h-fit pt-4 pb-8 flex place-content-center">
                    <div class="mx-4 md:mx-6 lg:mx-0">
                        <h4 class="text-[#333333] font-bold  text-[24px]">School Bus Driving </h4>
                        <img src="./asset/bus1.png" alt="" class="my-4">
                        <p class="text-[#333333] font-bold  text-[16px] mb-3">Features</p>
                        <ul class="list-disc list-inside ml-2 space-y-2">
                            <li class=" text-[12px] font-normal text-[#333333]">Comprehensive training for various types of forklift.</li>
                            <li class=" text-[12px] font-normal text-[#333333]">Hands-on experience .</li>
                            <li class=" text-[12px] font-normal text-[#333333]">Beginners and professional friendly</li>
                            <li class=" text-[12px] font-normal text-[#333333]">Driving techniques and safety measures</li>
                            <li class=" text-[12px] font-normal text-[#333333]">Certificate upon completion</li>
                        </ul>
                        <p class="text-[#333333] font-bold text-[16px] mt-4">Requirements</p>
                        <div class="pb-6">
                            <div class="flex h-fit mt-3 gap-3">
                                <i class='bx bx-check-circle text-[20px] text-[#333333] font-bold h-fit my-auto'></i>
                                <p class=" text-[12px] font-normal text-[#333333] h-fit my-auto">Valid driver’s licence</p>
                            </div>
                            <div class="flex h-fit mt-3 gap-3">
                                <i class='bx bx-check-circle text-[20px] text-[#333333] font-bold h-fit my-auto'></i>
                                <p class=" text-[12px] font-normal text-[#333333] h-fit my-auto">Driving experience</p>
                            </div>
                            <div class="flex h-fit mt-3 gap-3">
                                <i class='bx bx-check-circle text-[20px] text-[#333333] font-bold h-fit my-auto'></i>
                                <p class=" text-[12px] font-normal text-[#333333] h-fit my-auto">Must be above 18 years old</p>
                            </div>
                            <div class="flex h-fit mt-3 gap-3">
                                <i class='bx bx-check-circle text-[20px] text-[#333333] font-bold h-fit my-auto'></i>
                                <p class=" text-[12px] font-normal text-[#333333] h-fit my-auto">Ability to pass physical and drug screening.</p>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- Slider Item 4 -->
                <div class="slider-item flex-none w-full sm:w-1/2  lg:w-[400px]  rounded-[15px] border-[1px] border-[#808080] h-fit pt-4 pb-8 flex place-content-center">
                    <div class="mx-4 md:mx-6 lg:mx-0">
                        <h4 class="text-[#333333] font-bold  text-[24px]">Truck Driving </h4>
                        <img src="./asset/truck1.png" alt="" class="my-4">
                        <p class="text-[#333333] font-bold  text-[16px] mb-3">Features</p>
                        <ul class="list-disc list-inside ml-2 space-y-2">
                            <li class=" text-[12px] font-normal text-[#333333]">Comprehensive training for various types of forklift.</li>
                            <li class=" text-[12px] font-normal text-[#333333]">Hands-on experience .</li>
                            <li class=" text-[12px] font-normal text-[#333333]">Beginners and professional friendly</li>
                            <li class=" text-[12px] font-normal text-[#333333]">Driving techniques and safety measures</li>
                            <li class=" text-[12px] font-normal text-[#333333]">Certificate upon completion</li>
                        </ul>
                        <p class="text-[#333333] font-bold text-[16px] mt-4">Requirements</p>
                        <div class="pb-6">
                            <div class="flex h-fit mt-3 gap-3">
                                <i class='bx bx-check-circle text-[20px] text-[#333333] font-bold h-fit my-auto'></i>
                                <p class=" text-[12px] font-normal text-[#333333] h-fit my-auto">Valid driver’s licence</p>
                            </div>
                            <div class="flex h-fit mt-3 gap-3">
                                <i class='bx bx-check-circle text-[20px] text-[#333333] font-bold h-fit my-auto'></i>
                                <p class=" text-[12px] font-normal text-[#333333] h-fit my-auto">Driving experience</p>
                            </div>
                            <div class="flex h-fit mt-3 gap-3">
                                <i class='bx bx-check-circle text-[20px] text-[#333333] font-bold h-fit my-auto'></i>
                                <p class=" text-[12px] font-normal text-[#333333] h-fit my-auto">Must be above 18 years old</p>
                            </div>
                            <div class="flex h-fit mt-3 gap-3">
                                <i class='bx bx-check-circle text-[20px] text-[#333333] font-bold h-fit my-auto'></i>
                                <p class=" text-[12px] font-normal text-[#333333] h-fit my-auto">Ability to pass physical and drug screening.</p>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- Slider Item 5 -->
                <div class="slider-item flex-none w-full sm:w-1/2  lg:w-[400px]  rounded-[15px] border-[1px] border-[#808080] h-fit pt-4 pb-8 flex place-content-center">
                    <div class="mx-4 md:mx-6 lg:mx-0">
                        <h4 class="text-[#333333] font-bold  text-[24px]">Forklift Driving </h4>
                        <img src="./asset/fork1.png" alt="" class="my-4">
                        <p class="text-[#333333] font-bold  text-[16px] mb-3">Features</p>
                        <ul class="list-disc list-inside ml-2 space-y-2">
                            <li class=" text-[12px] font-normal text-[#333333]">Comprehensive training for various types of forklift.</li>
                            <li class=" text-[12px] font-normal text-[#333333]">Hands-on experience .</li>
                            <li class=" text-[12px] font-normal text-[#333333]">Beginners and professional friendly</li>
                            <li class=" text-[12px] font-normal text-[#333333]">Driving techniques and safety measures</li>
                            <li class=" text-[12px] font-normal text-[#333333]">Certificate upon completion</li>
                        </ul>
                        <p class="text-[#333333] font-bold text-[16px] mt-4">Requirements</p>
                        <div class="pb-6">
                            <div class="flex h-fit mt-3 gap-3">
                                <i class='bx bx-check-circle text-[20px] text-[#333333] font-bold h-fit my-auto'></i>
                                <p class=" text-[12px] font-normal text-[#333333] h-fit my-auto">Valid driver’s licence</p>
                            </div>
                            <div class="flex h-fit mt-3 gap-3">
                                <i class='bx bx-check-circle text-[20px] text-[#333333] font-bold h-fit my-auto'></i>
                                <p class=" text-[12px] font-normal text-[#333333] h-fit my-auto">Driving experience</p>
                            </div>
                            <div class="flex h-fit mt-3 gap-3">
                                <i class='bx bx-check-circle text-[20px] text-[#333333] font-bold h-fit my-auto'></i>
                                <p class=" text-[12px] font-normal text-[#333333] h-fit my-auto">Must be above 18 years old</p>
                            </div>
                            <div class="flex h-fit mt-3 gap-3">
                                <i class='bx bx-check-circle text-[20px] text-[#333333] font-bold h-fit my-auto'></i>
                                <p class=" text-[12px] font-normal text-[#333333] h-fit my-auto">Ability to pass physical and drug screening.</p>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- Slider Item 6 -->
                <div class="slider-item flex-none w-full sm:w-1/2  lg:w-[400px]  rounded-[15px] border-[1px] border-[#808080] h-fit pt-4 pb-8 flex place-content-center">
                    <div class="mx-4 md:mx-6 lg:mx-0">
                        <h4 class="text-[#333333] font-bold  text-[24px]">School Bus Driving </h4>
                        <img src="./asset/bus1.png" alt="" class="my-4">
                        <p class="text-[#333333] font-bold  text-[16px] mb-3">Features</p>
                        <ul class="list-disc list-inside ml-2 space-y-2">
                            <li class=" text-[12px] font-normal text-[#333333]">Comprehensive training for various types of forklift.</li>
                            <li class=" text-[12px] font-normal text-[#333333]">Hands-on experience .</li>
                            <li class=" text-[12px] font-normal text-[#333333]">Beginners and professional friendly</li>
                            <li class=" text-[12px] font-normal text-[#333333]">Driving techniques and safety measures</li>
                            <li class=" text-[12px] font-normal text-[#333333]">Certificate upon completion</li>
                        </ul>
                        <p class="text-[#333333] font-bold text-[16px] mt-4">Requirements</p>
                        <div class="pb-6">
                            <div class="flex h-fit mt-3 gap-3">
                                <i class='bx bx-check-circle text-[20px] text-[#333333] font-bold h-fit my-auto'></i>
                                <p class=" text-[12px] font-normal text-[#333333] h-fit my-auto">Valid driver’s licence</p>
                            </div>
                            <div class="flex h-fit mt-3 gap-3">
                                <i class='bx bx-check-circle text-[20px] text-[#333333] font-bold h-fit my-auto'></i>
                                <p class=" text-[12px] font-normal text-[#333333] h-fit my-auto">Driving experience</p>
                            </div>
                            <div class="flex h-fit mt-3 gap-3">
                                <i class='bx bx-check-circle text-[20px] text-[#333333] font-bold h-fit my-auto'></i>
                                <p class=" text-[12px] font-normal text-[#333333] h-fit my-auto">Must be above 18 years old</p>
                            </div>
                            <div class="flex h-fit mt-3 gap-3">
                                <i class='bx bx-check-circle text-[20px] text-[#333333] font-bold h-fit my-auto'></i>
                                <p class=" text-[12px] font-normal text-[#333333] h-fit my-auto">Ability to pass physical and drug screening.</p>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <!-- Pagination Dots -->
            <div class="pagination-dots">
                <!-- Dots will be dynamically generated -->
            </div>
        </div>



    </div>
</div>



@push('style')
<style>
    .nav-right .langSel {
        padding: 7px 20px;
        height: 37px;
    }
</style>
@endpush
