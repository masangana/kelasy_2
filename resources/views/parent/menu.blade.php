  <!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link" href="index.html">
          <i class="bi bi-grid"></i>
          <span>Dashboard</span>
        </a>
      </li><!-- End Dashboard Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-menu-button-wide"></i><span>Enfants</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="components-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
            @foreach ($parent->aDesEnfants as $enfant )
                <li>
                    <a href="{{route('enfant.show', $enfant->eleve->id)}}">
                    <i class="bi bi-circle"></i><span>{{$enfant->eleve->personne->nom}} {{$enfant->eleve->personne->postnom}} {{$enfant->eleve->personne->prenom}} </span>
                    </a>
                </li>
            @endforeach 
        </ul>
      </li><!-- End Components Nav -->

        @foreach ($parent->aDesEnfants as $enfant )
            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#charts-nav-{{$enfant->eleve->id}}" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-bar-chart"></i>
                        <span>
                            {{$enfant->eleve->personne->nom}} {{$enfant->eleve->personne->postnom}} {{$enfant->eleve->personne->prenom}}
                        </span>
                    <i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="charts-nav-{{$enfant->eleve->id}}" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                    @foreach ($enfant->eleve->isPupil as $classe )
                        <li>
                            <a href="{{route('enfant.show', $classe->pivot->id)}}">
                            <i class="bi bi-circle"></i><span>{{$classe->nom}}</span>
                            </a>
                        </li>
                    @endforeach
                </ul>
            </li><!-- End Charts Nav -->
        @endforeach
      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#icons-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-gem"></i><span>Icons</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="icons-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="icons-bootstrap.html">
              <i class="bi bi-circle"></i><span>Bootstrap Icons</span>
            </a>
          </li>
          <li>
            <a href="icons-remix.html">
              <i class="bi bi-circle"></i><span>Remix Icons</span>
            </a>
          </li>
          <li>
            <a href="icons-boxicons.html">
              <i class="bi bi-circle"></i><span>Boxicons</span>
            </a>
          </li>
        </ul>
      </li><!-- End Icons Nav -->

      <li class="nav-heading">Pages</li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="users-profile.html">
          <i class="bi bi-person"></i>
          <span>Profile</span>
        </a>
      </li><!-- End Profile Page Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="pages-faq.html">
          <i class="bi bi-question-circle"></i>
          <span>F.A.Q</span>
        </a>
      </li><!-- End F.A.Q Page Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="pages-contact.html">
          <i class="bi bi-envelope"></i>
          <span>Contact</span>
        </a>
      </li><!-- End Contact Page Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="pages-register.html">
          <i class="bi bi-card-list"></i>
          <span>Register</span>
        </a>
      </li><!-- End Register Page Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="pages-login.html">
          <i class="bi bi-box-arrow-in-right"></i>
          <span>Login</span>
        </a>
      </li><!-- End Login Page Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="pages-error-404.html">
          <i class="bi bi-dash-circle"></i>
          <span>Error 404</span>
        </a>
      </li><!-- End Error 404 Page Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="pages-blank.html">
          <i class="bi bi-file-earmark"></i>
          <span>Blank</span>
        </a>
      </li><!-- End Blank Page Nav -->

    </ul>

  </aside><!-- End Sidebar-->