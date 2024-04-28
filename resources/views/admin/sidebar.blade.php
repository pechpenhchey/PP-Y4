<style>
/* Custom CSS for sidebar */
.sidebar {
  background-color: #f1f1f1;
  width: auto; /* Set width to auto to wrap content */
  max-width: 80%; /* Set max-width to limit the width */
}

.sidebar-header {
  font-size: 24px; /* Increase font size for Admin menu text */
}

.sidebar a {
  color: black;
  text-decoration: none;
}

.sidebar a.active {
  background-color: #04AA6D;
  color: white;
}

.sidebar a:hover:not(.active) {
  background-color: #555;
  color: white;
}

/* Adjust padding for list items */
.navbar-nav .nav-link {
  padding: 10px 20px;
}

/* Increase font size for list items */
.navbar-nav .nav-link i {
  font-size: 24px; /* Increase icon size */
  margin-right: 10px; /* Add space between icon and text */
}

.navbar-nav .nav-link span {
  font-size: 20px; /* Increase text size */
}
</style>
</head>
<body>

<div class="offcanvas offcanvas-start" tabindex="-1" id="sidebarMenu" aria-labelledby="sidebarMenu">
  <div class="offcanvas-header">
    <h1 class="p-3 sidebar-header"><b>Admin menu</b></h1>
    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
  <div class="offcanvas-body">
  <ul class="navbar-nav me-auto mb-2 mb-lg-0">
      <li class="nav-item">
      <a class="nav-link" href="{{ route('admin.dashboard') }}">
          <i class="fas fa-tachometer-alt"></i>
          <span>Dashboard</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.users.index') }}">
          <i class="fa-solid fa-user"></i>
          <span>User management</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{ route('categories.index') }}">
          <i class="fas fa-list"></i>
          <span>Category management</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{ route('products.index') }}">
          <i class="fas fa-box-open"></i>
          <span>Food management</span>
        </a>
      </li>
    </ul>
  </div>
</div>

<button class="btn me-5" type="button" data-bs-toggle="offcanvas" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu">
  <i class="fas fa-bars"></i>
</button>