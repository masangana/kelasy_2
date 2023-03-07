
@extends('layouts.app')

@section('content')
<section class="section profile">
    <div class="row">
        <div class="col-xl-2">
        </div>

        <div class="col-xl-8">
            <div class="card">
                <div class="card-body pt-3">
                <ul class="nav nav-tabs nav-tabs-bordered">
                    <li class="nav-item">
                        <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-edit">E-Bulletin</button>
                    </li>
                </ul>
                <div class="tab-content pt-2">
                    <div class="tab-pane fade show active profile-edit pt-3" id="profile-edit">
                        <h5 class="card-title">
                            
                        </h5>
                        <div class="table-responsive">
                            <table class="text-center table table-bordered">
                                <thead>
                                    <tr class="text-left">
                                        <th colspan="4">
                                        </th>
                                        <th colspan="6" class="text-left">
                                            Eleve : {{$eleve->personne->nom}} {{$eleve->personne->postnom}} {{$eleve->personne->prenom}}
                                            <br>
                                            Né(e) à : {{$eleve->personne->lieu_naissance}} le {{$eleve->personne->date_naissance->format('d/m/Y')}}
                                            <br>
                                            Classe : {{$classe->nom}}
                                        </th>
                                    </tr>
                                    <tr>
                                        <th class="align-middle" rowspan="2">
                                            BRANCHES
                                        </th>
                                        <th colspan="4">
                                            PREMIER SEMESTRE
                                        </th>
                                        <th colspan="4">
                                            SEMESTRE SECOND
                                        </th>
                                        <th class="align-middle" rowspan="2">
                                            T.G
                                        </th>
                                        </tr>
                                        <tr>
                                        <th>
                                            1e P
                                        </th>
                                        <th>
                                            2e P
                                        </th>
                                        <th>
                                            EXAM
                                        </th>
                                        <th>
                                            TOT
                                        </th>
                                        <th>
                                            1e P
                                        </th>
                                        <th>
                                            2e P
                                        </th>
                                        <th>
                                            EXAM
                                        </th>
                                        <th>
                                            TOT
                                        </th>
                                    </tr>
                                    <tr>
                                        <th class="text-rigth">
                                            MAXIMA
                                        </th>
                                        <th>
                                            10
                                        </th>
                                        <th>
                                            10
                                        </th>
                                        <th>
                                            20
                                        </th>
                                        <th>
                                            40
                                        </th>
                                        <th>
                                            10
                                        </th>
                                        <th>
                                            10
                                        </th>
                                        <th>
                                            20
                                        </th>
                                        <th>
                                            40
                                        </th>
                                        <th>
                                            80
                                        </th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @php
                                        $totalP1 = [];
                                        $totalP2 = [];
                                        $totalP3 = [];
                                        $totalP4 = [];
                                        $totalExam2 = [];
                                        $totalExam1 = [];
                                        $totalGen = [];
                                    @endphp
                                    @foreach ( $classe->cours as $cours )
                                        @if ($cours->max_periode == 10)
                                        <tr>
                                            <th scope="row" class="text-left">
                                            {{$cours->nom}}
                                            </th>
                                            @php
                                            $p1 = "";
                                            $p2 = "";
                                            $p3 = "";
                                            $p4 = "";
                                            $exam1 = "";
                                            $exam2 = "";
                                            @endphp
                                            @foreach ( $cours->archivedPeriode as $resultat )
                                            @foreach ($periodes as $periode )
                                                @php
                                                    $sommeCote = 0;
                                                    $sommeMax = 0;
                                                @endphp
                                                @if ($resultat->periode_id == $periode->id)

                                                    @foreach ( $eleve->hasCoteByCursus as $index => $lesCotes)
                                                        @if (($lesCotes->cours_id == $cours->id) && ($lesCotes->periode->id == $resultat->periode_id))
                                                        @php
                                                            $sommeCote += $lesCotes->cote;
                                                            $sommeMax += $lesCotes->max;
                                                        @endphp
                                                        @endif
                                                    @endforeach
                                                    
                                                    @if ($periode->nom == 'Première Période' )
                                                        @php
                                                        $p1 = round(($sommeCote * $cours->max_periode)/ $sommeMax);
                                                        @endphp
                                                    @endif
                                                    
                                                    @if ($periode->nom == 'Deuxième Période' )
                                                        @php
                                                        $p2 = round(($sommeCote * $cours->max_periode)/ $sommeMax);
                                                        @endphp
                                                    @endif

                                                    @if ($periode->nom == 'Troisième Periode' )
                                                        @php
                                                        $p3 = round(($sommeCote * $cours->max_periode)/ $sommeMax)
                                                        @endphp
                                                    @endif

                                                    @if ($periode->nom == 'Quatrième Periode' )
                                                        @php
                                                        $p4 = round(($sommeCote * $cours->max_periode)/ $sommeMax)
                                                        @endphp
                                                    @endif

                                                    @if ($periode->nom == 'Premier Semestre' )
                                                        @php
                                                        $exam1 = round(($sommeCote * $cours->max_examen)/ $sommeMax)
                                                        @endphp
                                                    @endif
                                                    
                                                    @if ($periode->nom == 'Deuxième Semestre' )
                                                        @php
                                                        $exam2 = round(($sommeCote * $cours->max_examen)/ $sommeMax)
                                                        @endphp
                                                    @endif
                                                @endif
                                            @endforeach
                                            @endforeach
                                            @php
                                            $totalP1[] = $p1;
                                            $totalP2[] = $p2;
                                            $totalP3[] = $p3;
                                            $totalP4[] = $p4;
                                            $totalExam1[] = $exam1;
                                            $totalExam2[] = $exam2;
                                            @endphp
                                            <td>
                                            @if ($p1 < $cours->max_periode/2)
                                                <span class="text-danger">{{$p1}}</span>
                                            @else
                                                {{$p1}}
                                            @endif
                                            </td>
                                            <td>
                                            @if ($p2 < $cours->max_periode/2)
                                                <span class="text-danger">{{$p2}}</span>
                                            @else
                                                {{$p2}}
                                            @endif
                                            </td>
                                            <td>
                                            @if ($exam1 < $cours->max_examen/2)
                                                <span class="text-danger">{{$exam1}}</span>
                                            @else
                                                {{$exam1}}
                                            @endif
                                            </td>
                                            <td>
                                            @if ($p1 == "" || $p2 == "" || $exam1 == "")
                                            @else
                                                @if (($p1 + $p2 + $exam1) < $cours->max_examen/2)
                                                <span class="text-danger">{{$p1 + $p2 + $exam1}}</span>
                                                @else
                                                {{$p1 + $p2 + $exam1}}
                                                @endif
                                            @endif
                                            
                                            </td>
                                            <td>
                                            @if ($p3 < $cours->max_periode/2)
                                                <span class="text-danger">{{$p3}}</span>
                                            @else
                                                {{$p3}}
                                            @endif
                                            </td>
                                            <td>
                                            @if ($p4 < $cours->max_periode/2)
                                                <span class="text-danger">{{$p4}}</span>
                                            @else
                                                {{$p4}}
                                            @endif
                                            </td>
                                            <td>
                                            @if ($exam2 < $cours->max_examen/2)
                                                <span class="text-danger">{{$exam2}}</span>
                                            @else
                                                {{$exam2}}
                                            @endif
                                            </td>
                                            <td>
                                            @if ($p3 == "" || $p4 == "" || $exam2 == "")
                                            @else
                                                @if (($p3 + $p4 + $exam2) < $cours->max_examen/2)
                                                <span class="text-danger">{{$p3 + $p4 + $exam2}}</span>
                                                @else
                                                {{$p3 + $p4 + $exam2}}
                                                @endif
                                            @endif
                                            </td>
                                            <td>
                                            @if ($p1 == "" || $p2 == "" || $exam1 == "" || $p3 == "" || $p4 == "" || $exam2 == "")
                                            @else
                                                @if (($p1 + $p2 + $exam1 + $p3 + $p4 + $exam2) < $cours->max_examen/2)
                                                <span class="text-danger">{{$p1 + $p2 + $exam1 + $p3 + $p4 + $exam2}}</span>
                                                @else
                                                {{$p1 + $p2 + $exam1 + $p3 + $p4 + $exam2}}
                                                @endif
                                            @endif
                                            </td>
                                        </tr>
                                        @endif
                                    @endforeach
                                    <tr>
                                        <th scope="row">
                                            MAXIMA
                                        </th>
                                        <th>
                                            20
                                        </th>
                                        <th>
                                            20
                                        </th>
                                        <th>
                                            40
                                        </th>
                                        <th>
                                            80
                                        </th>
                                        <th>
                                            20
                                        </th>
                                        <th>
                                            20
                                        </th>
                                        <th>
                                            40
                                        </th>
                                        <th>
                                            80
                                        </th>
                                        <th>
                                            160
                                        </th>
                                    </tr>
                                    @foreach ( $classe->cours as $cours )
                                        @if ($cours->max_periode == 20)
                                        <tr>
                                            <th scope="row" class="text-left">
                                            {{$cours->nom}}
                                            </th>
                                            @php
                                                $p1 = "";
                                                $p2 = "";
                                                $p3 = "";
                                                $p4 = "";
                                                $exam1 = "";
                                                $exam2 = "";
                                            @endphp
                                            @foreach ( $cours->archivedPeriode as $resultat )
                                                @foreach ($periodes as $periode )
                                                    @php
                                                        $sommeCote = 0;
                                                        $sommeMax = 0;
                                                    @endphp
                                                    @if ($resultat->periode_id == $periode->id)

                                                        @foreach ( $eleve->hasCoteByCursus as $index => $lesCotes)
                                                            @if (($lesCotes->cours_id == $cours->id) && ($lesCotes->periode->id == $resultat->periode_id))
                                                                @php
                                                                    $sommeCote += $lesCotes->cote;
                                                                    $sommeMax += $lesCotes->max;
                                                                @endphp
                                                            @endif
                                                        @endforeach
                                                        
                                                        @if ($periode->nom == 'Première Période' )
                                                            @php
                                                            $p1 = round(($sommeCote * $cours->max_periode)/ $sommeMax);
                                                            @endphp
                                                        @endif
                                                        
                                                        @if ($periode->nom == 'Deuxième Période' )
                                                            @php
                                                            $p2 = round(($sommeCote * $cours->max_periode)/ $sommeMax);
                                                            @endphp
                                                        @endif

                                                        @if ($periode->nom == 'Troisième Periode' )
                                                            @php
                                                            $p3 = round(($sommeCote * $cours->max_periode)/ $sommeMax)
                                                            @endphp
                                                        @endif

                                                        @if ($periode->nom == 'Quatrième Periode' )
                                                            @php
                                                            $p4 = round(($sommeCote * $cours->max_periode)/ $sommeMax)
                                                            @endphp
                                                        @endif

                                                        @if ($periode->nom == 'Premier Semestre' )
                                                            @php
                                                            $exam1 = round(($sommeCote * $cours->max_examen)/ $sommeMax)
                                                            @endphp
                                                        @endif
                                                        
                                                        @if ($periode->nom == 'Deuxième Semestre' )
                                                            @php
                                                            $exam2 = round(($sommeCote * $cours->max_examen)/ $sommeMax)
                                                            @endphp
                                                        @endif
                                                    @endif
                                                @endforeach
                                            @endforeach
                                            @php
                                                $totalP1[] = $p1;
                                                $totalP2[] = $p2;
                                                $totalP3[] = $p3;
                                                $totalP4[] = $p4;
                                                $totalExam1[] = $exam1;
                                                $totalExam2[] = $exam2;
                                            @endphp
                                            <td>
                                            @if ($p1 < $cours->max_periode/2)
                                                <span class="text-danger">{{$p1}}</span>
                                            @else
                                                {{$p1}}
                                            @endif
                                            </td>
                                            <td>
                                            @if ($p2 < $cours->max_periode/2)
                                                <span class="text-danger">{{$p2}}</span>
                                            @else
                                                {{$p2}}
                                            @endif
                                            </td>
                                            <td>
                                            @if ($exam1 < $cours->max_examen/2)
                                                <span class="text-danger">{{$exam1}}</span>
                                            @else
                                                {{$exam1}}
                                            @endif
                                            </td>
                                            <td>
                                            @if ($p1 == "" || $p2 == "" || $exam1 == "")
                                            @else
                                                @if (($p1 + $p2 + $exam1) < $cours->max_examen/2)
                                                    <span class="text-danger">{{$p1 + $p2 + $exam1}}</span>
                                                @else
                                                    {{$p1 + $p2 + $exam1}}
                                                @endif
                                            @endif
                                            
                                            </td>
                                            <td>
                                            @if ($p3 < $cours->max_periode/2)
                                                <span class="text-danger">{{$p3}}</span>
                                            @else
                                                {{$p3}}
                                            @endif
                                            </td>
                                            <td>
                                            @if ($p4 < $cours->max_periode/2)
                                                <span class="text-danger">{{$p4}}</span>
                                            @else
                                                {{$p4}}
                                            @endif
                                            </td>
                                            <td>
                                            @if ($exam2 < $cours->max_examen/2)
                                                <span class="text-danger">{{$exam2}}</span>
                                            @else
                                                {{$exam2}}
                                            @endif
                                            </td>
                                            <td>
                                            @if ($p3 == "" || $p4 == "" || $exam2 == "")
                                            @else
                                                @if (($p3 + $p4 + $exam2) < $cours->max_examen/2)
                                                <span class="text-danger">{{$p3 + $p4 + $exam2}}</span>
                                                @else
                                                {{$p3 + $p4 + $exam2}}
                                                @endif
                                            @endif
                                            </td>
                                            <td>
                                            @if ($p1 == "" || $p2 == "" || $exam1 == "" || $p3 == "" || $p4 == "" || $exam2 == "")
                                            @else
                                                @if (($p1 + $p2 + $exam1 + $p3 + $p4 + $exam2) < $cours->max_examen/2)
                                                <span class="text-danger">{{$p1 + $p2 + $exam1 + $p3 + $p4 + $exam2}}</span>
                                                @else
                                                {{$p1 + $p2 + $exam1 + $p3 + $p4 + $exam2}}
                                                @endif
                                            @endif
                                            </td>
                                        </tr>
                                        @endif
                                    @endforeach
                                    <tr>
                                        <th scope="row">
                                            MAXIMA
                                        </th>
                                        <th>
                                            40
                                        </th>
                                        <th>
                                            40
                                        </th>
                                        <th>
                                            80
                                        </th>
                                        <th>
                                            160
                                        </th>
                                        <th>
                                            40
                                        </th>
                                        <th>
                                            40
                                        </th>
                                        <th>
                                            80
                                        </th>
                                        <th>
                                            160
                                        </th>
                                        <th>
                                            320
                                        </th>
                                    </tr>
                                    @foreach ( $classe->cours as $cours )
                                        @if ($cours->max_periode == 40)
                                            <tr>
                                                <th scope="row" class="text-left">
                                                {{$cours->nom}}
                                                </th>
                                                @php
                                                $p1 = "";
                                                $p2 = "";
                                                $p3 = "";
                                                $p4 = "";
                                                $exam1 = "";
                                                $exam2 = "";
                                                @endphp
                                                @foreach ( $cours->archivedPeriode as $resultat )
                                                @foreach ($periodes as $periode )
                                                    @php
                                                        $sommeCote = 0;
                                                        $sommeMax = 0;
                                                    @endphp
                                                    @if ($resultat->periode_id == $periode->id)

                                                        @foreach ( $eleve->hasCoteByCursus as $index => $lesCotes)
                                                            @if (($lesCotes->cours_id == $cours->id) && ($lesCotes->periode->id == $resultat->periode_id))
                                                            @php
                                                                $sommeCote += $lesCotes->cote;
                                                                $sommeMax += $lesCotes->max;
                                                            @endphp
                                                            @endif
                                                        @endforeach
                                                        
                                                        @if ($periode->nom == 'Première Période' )
                                                            @php
                                                            $p1 = round(($sommeCote * $cours->max_periode)/ $sommeMax);
                                                            @endphp
                                                        @endif
                                                        
                                                        @if ($periode->nom == 'Deuxième Période' )
                                                            @php
                                                            $p2 = round(($sommeCote * $cours->max_periode)/ $sommeMax);
                                                            @endphp
                                                        @endif

                                                        @if ($periode->nom == 'Troisième Periode' )
                                                            @php
                                                            $p3 = round(($sommeCote * $cours->max_periode)/ $sommeMax)
                                                            @endphp
                                                        @endif

                                                        @if ($periode->nom == 'Quatrième Periode' )
                                                            @php
                                                            $p4 = round(($sommeCote * $cours->max_periode)/ $sommeMax)
                                                            @endphp
                                                        @endif

                                                        @if ($periode->nom == 'Premier Semestre' )
                                                            @php
                                                            $exam1 = round(($sommeCote * $cours->max_examen)/ $sommeMax)
                                                            @endphp
                                                        @endif
                                                        
                                                        @if ($periode->nom == 'Deuxième Semestre' )
                                                            @php
                                                            $exam2 = round(($sommeCote * $cours->max_examen)/ $sommeMax)
                                                            @endphp
                                                        @endif
                                                    @endif
                                                @endforeach
                                                @endforeach
                                                @php
                                                $totalP1[] = $p1;
                                                $totalP2[] = $p2;
                                                $totalP3[] = $p3;
                                                $totalP4[] = $p4;
                                                $totalExam1[] = $exam1;
                                                $totalExam2[] = $exam2;
                                                @endphp
                                                <td>
                                                @if ($p1 < $cours->max_periode/2)
                                                    <span class="text-danger">{{$p1}}</span>
                                                @else
                                                    {{$p1}}
                                                @endif
                                                </td>
                                                <td>
                                                @if ($p2 < $cours->max_periode/2)
                                                    <span class="text-danger">{{$p2}}</span>
                                                @else
                                                    {{$p2}}
                                                @endif
                                                </td>
                                                <td>
                                                @if ($exam1 < $cours->max_examen/2)
                                                    <span class="text-danger">{{$exam1}}</span>
                                                @else
                                                    {{$exam1}}
                                                @endif
                                                </td>
                                                <td>
                                                @if ($p1 == "" || $p2 == "" || $exam1 == "")
                                                @else
                                                    @if (($p1 + $p2 + $exam1) < $cours->max_examen/2)
                                                    <span class="text-danger">{{$p1 + $p2 + $exam1}}</span>
                                                    @else
                                                    {{$p1 + $p2 + $exam1}}
                                                    @endif
                                                @endif
                                                
                                                </td>
                                                <td>
                                                @if ($p3 < $cours->max_periode/2)
                                                    <span class="text-danger">{{$p3}}</span>
                                                @else
                                                    {{$p3}}
                                                @endif
                                                </td>
                                                <td>
                                                @if ($p4 < $cours->max_periode/2)
                                                    <span class="text-danger">{{$p4}}</span>
                                                @else
                                                    {{$p4}}
                                                @endif
                                                </td>
                                                <td>
                                                @if ($exam2 < $cours->max_examen/2)
                                                    <span class="text-danger">{{$exam2}}</span>
                                                @else
                                                    {{$exam2}}
                                                @endif
                                                </td>
                                                <td>
                                                @if ($p3 == "" || $p4 == "" || $exam2 == "")
                                                @else
                                                    @if (($p3 + $p4 + $exam2) < $cours->max_examen/2)
                                                    <span class="text-danger">{{$p3 + $p4 + $exam2}}</span>
                                                    @else
                                                    {{$p3 + $p4 + $exam2}}
                                                    @endif
                                                @endif
                                                </td>
                                                <td>
                                                @if ($p1 == "" || $p2 == "" || $exam1 == "" || $p3 == "" || $p4 == "" || $exam2 == "")
                                                @else
                                                    @if (($p1 + $p2 + $exam1 + $p3 + $p4 + $exam2) < $cours->max_examen/2)
                                                    <span class="text-danger">{{$p1 + $p2 + $exam1 + $p3 + $p4 + $exam2}}</span>
                                                    @else
                                                    {{$p1 + $p2 + $exam1 + $p3 + $p4 + $exam2}}
                                                    @endif
                                                @endif
                                                </td>
                                            </tr>
                                        @endif
                                    @endforeach
                                    <tr>
                                        <th scope="row">
                                            MAXIMA
                                        </th>
                                        <th>
                                            50
                                        </th>
                                        <th>
                                            50
                                        </th>
                                        <th>
                                            100
                                        </th>
                                        <th>
                                            200
                                        </th>
                                        <th>
                                            50
                                        </th>
                                        <th>
                                            50
                                        </th>
                                        <th>
                                            100
                                        </th>
                                        <th>
                                            200
                                        </th>
                                        <th>
                                            400
                                        </th>
                                    </tr>
                                    @foreach ( $classe->cours as $cours )
                                        @if ($cours->max_periode == 50)
                                        <tr>
                                            <th scope="row" class="text-left">
                                                {{$cours->nom}}
                                            </th>
                                            @php
                                                $p1 = "";
                                                $p2 = "";
                                                $p3 = "";
                                                $p4 = "";
                                                $exam1 = "";
                                                $exam2 = "";
                                            @endphp
                                            @foreach ( $cours->archivedPeriode as $resultat )
                                                @foreach ($periodes as $periode )
                                                    @php
                                                        $sommeCote = 0;
                                                        $sommeMax = 0;
                                                    @endphp
                                                    @if ($resultat->periode_id == $periode->id)

                                                        @foreach ( $eleve->hasCoteByCursus as $index => $lesCotes)
                                                            @if (($lesCotes->cours_id == $cours->id) && ($lesCotes->periode->id == $resultat->periode_id))
                                                            @php
                                                                $sommeCote += $lesCotes->cote;
                                                                $sommeMax += $lesCotes->max;
                                                            @endphp
                                                            @endif
                                                        @endforeach
                                                        
                                                        @if ($periode->nom == 'Première Période' )
                                                            @php
                                                            $p1 = round(($sommeCote * $cours->max_periode)/ $sommeMax);
                                                            @endphp
                                                        @endif
                                                        
                                                        @if ($periode->nom == 'Deuxième Période' )
                                                            @php
                                                            $p2 = round(($sommeCote * $cours->max_periode)/ $sommeMax);
                                                            @endphp
                                                        @endif

                                                        @if ($periode->nom == 'Troisième Periode' )
                                                            @php
                                                            $p3 = round(($sommeCote * $cours->max_periode)/ $sommeMax)
                                                            @endphp
                                                        @endif

                                                        @if ($periode->nom == 'Quatrième Periode' )
                                                            @php
                                                            $p4 = round(($sommeCote * $cours->max_periode)/ $sommeMax)
                                                            @endphp
                                                        @endif

                                                        @if ($periode->nom == 'Premier Semestre' )
                                                            @php
                                                            $exam1 = round(($sommeCote * $cours->max_examen)/ $sommeMax)
                                                            @endphp
                                                        @endif
                                                        
                                                        @if ($periode->nom == 'Deuxième Semestre' )
                                                            @php
                                                            $exam2 = round(($sommeCote * $cours->max_examen)/ $sommeMax)
                                                            @endphp
                                                        @endif
                                                    @endif
                                                @endforeach
                                            @endforeach
                                            @php
                                                $totalP1[] = $p1;
                                                $totalP2[] = $p2;
                                                $totalP3[] = $p3;
                                                $totalP4[] = $p4;
                                                $totalExam1[] = $exam1;
                                                $totalExam2[] = $exam2;
                                                @endphp
                                            <td>
                                            @if ($p1 < $cours->max_periode/2)
                                                <span class="text-danger">{{$p1}}</span>
                                            @else
                                                {{$p1}}
                                            @endif
                                            </td>
                                            <td>
                                            @if ($p2 < $cours->max_periode/2)
                                                <span class="text-danger">{{$p2}}</span>
                                            @else
                                                {{$p2}}
                                            @endif
                                            </td>
                                            <td>
                                            @if ($exam1 < $cours->max_examen/2)
                                                <span class="text-danger">{{$exam1}}</span>
                                            @else
                                                {{$exam1}}
                                            @endif
                                            </td>
                                            <td>
                                            @if ($p1 == "" || $p2 == "" || $exam1 == "")
                                            @else
                                                @if (($p1 + $p2 + $exam1) < $cours->max_examen/2)
                                                <span class="text-danger">{{$p1 + $p2 + $exam1}}</span>
                                                @else
                                                {{$p1 + $p2 + $exam1}}
                                                @endif
                                            @endif
                                            
                                            </td>
                                            <td>
                                            @if ($p3 < $cours->max_periode/2)
                                                <span class="text-danger">{{$p3}}</span>
                                            @else
                                                {{$p3}}
                                            @endif
                                            </td>
                                            <td>
                                            @if ($p4 < $cours->max_periode/2)
                                                <span class="text-danger">{{$p4}}</span>
                                            @else
                                                {{$p4}}
                                            @endif
                                            </td>
                                            <td>
                                            @if ($exam2 < $cours->max_examen/2)
                                                <span class="text-danger">{{$exam2}}</span>
                                            @else
                                                {{$exam2}}
                                            @endif
                                            </td>
                                            <td>
                                            @if ($p3 == "" || $p4 == "" || $exam2 == "")
                                            @else
                                                @if (($p3 + $p4 + $exam2) < $cours->max_examen/2)
                                                <span class="text-danger">{{$p3 + $p4 + $exam2}}</span>
                                                @else
                                                {{$p3 + $p4 + $exam2}}
                                                @endif
                                            @endif
                                            </td>
                                            <td>
                                            @if ($p1 == "" || $p2 == "" || $exam1 == "" || $p3 == "" || $p4 == "" || $exam2 == "")
                                            @else
                                                @if (($p1 + $p2 + $exam1 + $p3 + $p4 + $exam2) < $cours->max_examen/2)
                                                <span class="text-danger">{{$p1 + $p2 + $exam1 + $p3 + $p4 + $exam2}}</span>
                                                @else
                                                {{$p1 + $p2 + $exam1 + $p3 + $p4 + $exam2}}
                                                @endif
                                            @endif
                                            </td>
                                        </tr>
                                        @endif
                                    @endforeach
                                    
                                    @php
                                        $maxiPer = 0;
                                        $maxExam = 0;
                                        $maxGen = 0;
                                    @endphp
                                    @foreach ( $classe->cours as $cours )
                                        @php
                                        $maxiPer += $cours->max_periode;
                                        $maxExam += $cours->max_examen;
                                        @endphp
                                    @endforeach
                                    <tr>
                                    <th scope="row">
                                        MAXIMA GENERAUX
                                    </th>
                                    <th>
                                        {{$maxiPer}}
                                    </th>
                                    <th>
                                        {{$maxiPer}}
                                    </th>
                                    <th>
                                        {{$maxExam}}
                                    </th>
                                    <th>
                                        {{ 2*$maxiPer + $maxExam}}
                                    </th>
                                    <th>
                                        {{$maxiPer}}
                                    </th>
                                    <th>
                                        {{$maxiPer}}
                                    </th>
                                    <th>
                                        {{$maxExam}}
                                    </th>
                                    <th>
                                        {{ 2*$maxiPer + $maxExam}}
                                    </th>
                                    <th>
                                        {{ 4*$maxiPer + 2*$maxExam}}
                                    </th>
                                    </tr>

                                    <tr>
                                    <th scope="row">
                                        TOTAUX
                                    </th>
                                    <td>
                                        @php
                                        $totalP1 = array_sum($totalP1);
                                        @endphp
                                        {{$totalP1}}
                                    </td>
                                    <td>
                                        @php
                                        $totalP2 = array_sum($totalP2);
                                        @endphp
                                        {{$totalP2}}
                                    </td>
                                    <td>
                                        @php
                                        $totalExam1 = array_sum($totalExam1);
                                        @endphp
                                        {{$totalExam1}}
                                    </td>
                                    <td>
                                        @php
                                        $totalGen1 = $totalP1 + $totalP2 + $totalExam1;
                                        @endphp
                                        {{$totalGen1}}
                                    </td>
                                    <td>
                                        @php
                                        $totalP3 = array_sum($totalP3);
                                        @endphp
                                        {{$totalP3}}
                                    </td>
                                    <td>
                                        @php
                                        $totalP4 = array_sum($totalP4);
                                        @endphp
                                        {{$totalP4}}
                                    </td>
                                    <td>
                                        @php
                                        $totalExam2 = array_sum($totalExam2);
                                        @endphp
                                        {{$totalExam2}}
                                    </td>
                                    <td>
                                        @php
                                        $totalGen2 = $totalP3 + $totalP4 + $totalExam2;
                                        @endphp
                                        {{$totalGen2}}
                                    </td>
                                    <td>
                                        @php
                                        $totalGen = $totalGen1 + $totalGen2;
                                        @endphp
                                        {{$totalGen}}
                                    </td>
                                    </tr>

                                    <tr>
                                    <th scope="row" class="text-left">
                                        POURCENTAGE
                                    </th>
                                    <th>
                                        @php
                                            if ($maxiPer == 0) {
                                                $pourcentageP1 = 0;
                                            }else {
                                                $pourcentageP1 = $totalP1 * 100 / $maxiPer;
                                            }
                                            
                                        @endphp
                                        {{round($pourcentageP1, 1)}}%
                                    </th>
                                    <th>
                                        @php
                                            if ($maxiPer == 0) {
                                                $pourcentageP2 = 0;
                                            } else {
                                                $pourcentageP2 = $totalP2 * 100 / $maxiPer;
                                            }
                                        @endphp
                                        {{round($pourcentageP2, 1)}}%
                                    </th>
                                    <th>
                                        @php
                                            if ($maxExam == 0) {
                                                $pourcentageExam1 = 0;
                                            } else {
                                                $pourcentageExam1 = $totalExam1 * 100 / $maxExam;
                                            }
                                        @endphp
                                        {{round($pourcentageExam1, 1)}}%
                                    </th>
                                    <th>
                                        @php
                                            if ($maxExam == 0 || $maxiPer == 0 ) {
                                                $pourcentageGen1 = 0;
                                            } else {
                                                $pourcentageGen1 = $totalGen1 * 100 / ($maxiPer + $maxiPer + $maxExam);
                                            }
                                        @endphp
                                        {{round($pourcentageGen1, 1)}}%
                                    </th>
                                    <th>
                                        @php
                                            if ($maxiPer == 0) {
                                                $pourcentageP3 = 0;
                                            } else {
                                                $pourcentageP3 = $totalP3 * 100 / $maxiPer;
                                            }
                                        @endphp
                                        {{round($pourcentageP3, 1)}}%
                                    </th>
                                    <th>
                                        @php
                                            if ($maxiPer == 0) {
                                                $pourcentageP4 = 0;
                                            } else {
                                                $pourcentageP4 = $totalP4 * 100 / $maxiPer;
                                            }
                                        @endphp
                                        {{round($pourcentageP4, 1)}}%
                                    </th>
                                    <th>
                                        @php
                                            if ($maxExam == 0) {
                                                $pourcentageExam2 = 0;
                                            } else {
                                                $pourcentageExam2 = $totalExam2 * 100 / $maxExam;
                                            }
                                        @endphp
                                        {{round($pourcentageExam2, 1)}}%
                                    </th>
                                    <th>
                                        @php
                                            if ($maxExam == 0 || $maxiPer == 0 ) {
                                                $pourcentageGen2 = 0;
                                            } else {
                                                $pourcentageGen2 = $totalGen2 * 100 / ($maxiPer + $maxiPer + $maxExam);
                                            }
                                        @endphp
                                        {{round($pourcentageGen2, 1)}}%
                                    </th>
                                    <th>
                                        @php
                                            if ($maxExam == 0 || $maxiPer == 0 ) {
                                                $pourcentageGen = 0;
                                            } else {
                                                $pourcentageGen = $totalGen * 100 / (2*$maxiPer + $maxExam + 2*$maxiPer + $maxExam);
                                            }
                                        @endphp
                                        {{round($pourcentageGen, 1)}}%
                                    </th>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
  
    @foreach ($classe->cours as $cours )
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">{{$cours->nom}}</h5>

                    <!-- Accordion without outline borders -->
                    <div class="accordion accordion-flush" id="accordionFlushExample">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="flush-heading{{$cours->id}}">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse{{$cours->id}}" aria-expanded="false" aria-controls="flush-collapse{{$cours->id}}">
                                Détails
                            </button>
                        </h2>
                        <div id="flush-collapse{{$cours->id}}" class="accordion-collapse collapse" aria-labelledby="flush-heading{{$cours->id}}" data-bs-parent="#accordionFlushExample">
                            <div class="accordion-body">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="card-title">
                                        Total Cours : <span class="text-primary">{{$cours->maximum}}</span> | 
                                        Total Examen : <span class="text-primary">{{$cours->max_examen}}</span> | 
                                        Total Période : <span class="text-primary">{{$cours->max_periode}}</span>
                                        </div>
                                    </div>
                                </div>

                                <table class="table">
                                <thead>
                                    <tr>
                                    <th scope="col">Période</th>
                                    <th scope="col">Global</th>
                                    <th scope="col">Moyenne</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($cours->archivedPeriode as $resultat)
                                    @foreach ($periodes as $periode )
                                        @if ($periode->id == $resultat->periode_id)
                                        @php
                                            $sommeCote = 0;
                                            $sommeMax = 0;
                                        @endphp
                                        @foreach ( $eleve->hasCoteByCursus as $index => $lesCotes)
                                            @if (($lesCotes->cours_id == $cours->id) && ($lesCotes->periode->id == $resultat->periode_id))
                                            @php
                                                $sommeCote += $lesCotes->cote;
                                                $sommeMax += $lesCotes->max;
                                            @endphp
                                            @endif
                                        @endforeach
                                        
                                        @if (round($sommeCote) < ($sommeMax/2))
                                            <tr class="table-danger" data-toggle="tooltip" data-placement="right" title="Moyenne arrondie à 0.5">
                                            <th scope="row">{{$periode->nom}}</th>
                                            <td>{{$sommeCote}} / {{$sommeMax}}</td>
                                            <td> {{ round(($sommeCote * $cours->max_periode)/ $sommeMax)}} / {{$cours->max_periode}}</td>
                                            </tr>
                                        @else
                                            <tr class="table-success">
                                            <th scope="row">{{$periode->nom}}</th>
                                            <td>{{$sommeCote}} / {{$sommeMax}}</td>
                                            <td> {{ round(($sommeCote * $cours->max_periode)/ $sommeMax)}} / {{$cours->max_periode}}</td>
                                            </tr>
                                        @endif
                                        @endif
                                    @endforeach
                                    @endforeach
                                </tbody>
                                </table>
                                <hr>
                                <table class="table table-bordered table-striped datatable">
                                    <thead>
                                    <tr>
                                        <th scope="col">Période</th>
                                        <th scope="col">Epreuve</th>
                                        <th scope="col">Cote</th>
                                        <th scope="col">Max</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ( $eleve->hasCoteByCursus as $index => $lesCotes )
                                            @if ($lesCotes->cours_id == $cours->id)
                                                <tr>
                                                    <td>{{$lesCotes->periode->nom}}</td>
                                                    <td>{{$lesCotes->epreuve->nom}}</td>
                                                    <td>{{$lesCotes->cote}}</td>
                                                    <td>{{$lesCotes->max}}</td>
                                                </tr>
                                            @endif
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    </div><!-- End Accordion without outline borders -->
                </div>
            </div>
        </div>
    @endforeach
    
</section>
@endsection