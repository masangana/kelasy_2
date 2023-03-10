  <!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link " href="{{Route('eleve.home')}} ">
          <i class="bi bi-grid"></i>
          <span>Dashboard Eleve</span>
        </a>
      </li><!-- End Dashboard Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="{{Route('paiement_eleve.index')}} ">
          <i class="bi bi-cash-coin"></i><span>Finance</span>
        </a>
      </li><!-- End Forms Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#tables-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-house"></i><span>Classes</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="tables-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          @foreach ($lesClasses as $laClasse )
            <li>
              <a href="{{Route('classe.show', $laClasse->classe->id)}}">
                <i class="bi bi-circle"></i><span>{{$laClasse->classe->nom}} </span>
              </a>
            </li>
          @endforeach
        </ul>
      </li><!-- End Tables Nav -->
      <li class="nav-heading">Personnel</li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="{{Route('profile.show', Auth::user()->id)}} ">
          <i class="bi bi-person"></i>
          <span>Profile</span>
        </a>
      </li><!-- End Profile Page Nav -->

    </ul>

</aside><!-- End Sidebar-->