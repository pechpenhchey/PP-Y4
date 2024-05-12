<div class="container">
    <div class="row flex bg-dark">
        <div class="col-auto col-md-3 col-xl-2 px-sm-2 px-0">
            <div class="d-flex flex-column align-items-center align-items-sm-start px-4 pt-2 text-white min-vh-100">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <a href="/home" class="d-flex align-items-center pb-3 mb-md-0 me-md-auto text-white px-3 py-4">
                            <span class="fs-5 d-none d-sm-inline" style="color: greenyellow;"><b>H</b><span style="color: red;"><b>Food</b></span>
                            </span>
                        </a>
                    </div>
                    <div class="hidden sm:flex sm:items-center sm:ms-6 text-nowrap pt-2">
                        <x-dropdown align="right" width="500">
                            <x-slot name="trigger">
                                <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                                    <div>{{ Auth::user()->name }}</div>
                                    <div class="ms-1">
                                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                </button>
                            </x-slot>

                            <x-slot name="content">
                                <x-dropdown-link :href="route('profile.edit')">
                                    {{ __('Profile') }}
                                </x-dropdown-link>

                                @auth
                                @if(auth()->user()->isAdmin())
                                <x-dropdown-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')">
                                    {{ __('Dashboard') }}
                                </x-dropdown-link>
                                @endif
                                @endauth

                                <!-- Authentication -->
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf

                                    <x-dropdown-link :href="route('logout')"
                                        onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                        {{ __('Log Out') }}
                                    </x-dropdown-link>
                                </form>
                            </x-slot>
                        </x-dropdown>
                    </div>
                </div>

                <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start pt-5" style="width: 200px;" id="menu">
                  <li class="nav-item">
                      <a class="nav-link text-white" href="{{ route('admin.dashboard') }}">
                          <div class="d-flex align-items-center">
                              <i class="fas fa-tachometer fa-fw me-2" style="font-size: 1rem;"></i>
                              <span>Dashboard</span>
                          </div>
                      </a>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link text-white" href="{{ route('admin.users.index') }}">
                          <div class="d-flex align-items-center">
                              <i class="fa-solid fa-user fa-fw me-2" style="font-size: 1rem;"></i>
                              <span>User</span>
                          </div>
                      </a>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link text-white" href="{{ route('categories.index') }}">
                          <div class="d-flex align-items-center">
                              <i class="fas fa-list fa-fw me-2" style="font-size: 1rem;"></i>
                              <span>Category</span>
                          </div>
                      </a>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link text-white" href="{{ route('products.index') }}">
                          <div class="d-flex align-items-center">
                              <i class="fas fa-box-open fa-fw me-2" style="font-size: 1rem;"></i>
                              <span>Food</span>
                          </div>
                      </a>
                  </li>
              </ul>

            </div>
        </div>
    </div>
</div>