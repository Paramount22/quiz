<ul class="navbar-nav bg-gradient-info sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{url('/')}}">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">QUIZ</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="{{url('/')}}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Interface
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapse-quiz"
           aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-book-open"></i>
            <span>Quiz</span>
        </a>
        <div id="collapse-quiz" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Quiz Section:</h6>
                <a class="collapse-item" href="{{route('quizzes.create')}}">Create</a>
                <a class="collapse-item" href="{{route('quizzes.index')}}">View</a>
            </div>
        </div>
    </li>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapse-question"
           aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-question-circle"></i>
            <span>Question</span>
        </a>
        <div id="collapse-question" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Question Section:</h6>
                <a class="collapse-item" href="{{route('questions.create')}}">Create</a>
                <a class="collapse-item" href="{{route('questions.index')}}">View</a>
            </div>
        </div>
    </li>

    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapse-user"
           aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-user"></i>
            <span>Users</span>
        </a>
        <div id="collapse-user" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">User Section:</h6>

                <a class="collapse-item" href="{{route('users.create')}}">Create</a>

                <a class="collapse-item" href="{{route('users.index')}}">View</a>
            </div>
        </div>
    </li>

    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapse-exam"
           aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-user"></i>
            <span>User exams</span>
        </a>
        <div id="collapse-exam" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">User exam Section:</h6>

                <a class="collapse-item" href="{{route('assign.exam')}}">Create</a>
                <a class="collapse-item" href="{{route('result')}}">Users results</a>
                <a class="collapse-item" href="{{route('view.exam')}}">View</a>
            </div>
        </div>
    </li>
    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

</ul>
