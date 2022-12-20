<?php
/** @var \AndreaMarelli\ImetCore\Models\Imet\Imet $assessments_v1 */
/** @var \AndreaMarelli\ImetCore\Models\Imet\Imet $assessments_v2 */
/** @var array $v1_stats_from_db */
/** @var array $v2_stats_from_db */

?>
@extends('layouts.admin')

@section('content')

    <h1>IMET v1</h1>
    <table class="striped">
        <thead>
            <tr>
                <th>assessment ID</th>
                <th>radar from DB</th>
                <th>radar from PHP</th>
            </tr>
        </thead>
        <tbody>
        @foreach($assessments_v1 as $id)
            <tr>
                <td>{{ $id }}</td>
                <td>
                    <div><b>C:</b> {{ $v1_stats_from_db[$id]['C'] }}</div>
                    <div><b>P:</b> {{ $v1_stats_from_db[$id]['P'] }}</div>
                    <div><b>I:</b> {{ $v1_stats_from_db[$id]['I'] }}</div>
                    <div><b>PR:</b> {{ $v1_stats_from_db[$id]['PR'] }}</div>
                    <div><b>R:</b> {{ $v1_stats_from_db[$id]['R'] }}</div>
                    <div><b>EI:</b> {{ $v1_stats_from_db[$id]['EI'] }}</div>
                </td>
                <td>
                    <div>
                        @if($v1_stats_from_db[$id]['C'] === $v1_stats_from_php[$id]['C'])
                            <i class="fas fa-check-circle" style="color: green;"></i>
                        @else
                            <i class="fas fa-times-circle" style="color: red;"></i>
                        @endif
                            <b>C:</b>{{ $v1_stats_from_php[$id]['C'] }}
                    </div>
                    <div>
                        @if($v1_stats_from_db[$id]['P'] === $v1_stats_from_php[$id]['P'])
                            <i class="fas fa-check-circle" style="color: green;"></i>
                        @else
                            <i class="fas fa-times-circle" style="color: red;"></i>
                        @endif
                            <b>P:</b>{{ $v1_stats_from_php[$id]['P'] }}
                    </div>
                    <div>
                        @if($v1_stats_from_db[$id]['I'] === $v1_stats_from_php[$id]['I'])
                            <i class="fas fa-check-circle" style="color: green;"></i>
                        @else
                            <i class="fas fa-times-circle" style="color: red;"></i>
                        @endif
                            <b>I:</b>{{ $v1_stats_from_php[$id]['I'] }}
                    </div>
                    <div>
                        @if($v1_stats_from_db[$id]['PR'] === $v1_stats_from_php[$id]['PR'])
                            <i class="fas fa-check-circle" style="color: green;"></i>
                        @else
                            <i class="fas fa-times-circle" style="color: red;"></i>
                        @endif
                            <b>PR:</b>{{ $v1_stats_from_php[$id]['PR'] }}
                    </div>
                    <div>
                        @if($v1_stats_from_db[$id]['R'] === $v1_stats_from_php[$id]['R'])
                            <i class="fas fa-check-circle" style="color: green;"></i>
                        @else
                            <i class="fas fa-times-circle" style="color: red;"></i>
                        @endif
                        <b>R:</b>{{ $v1_stats_from_php[$id]['R'] }}
                    </div>
                    <div>
                        @if($v1_stats_from_db[$id]['EI'] === $v1_stats_from_php[$id]['EI'])
                            <i class="fas fa-check-circle" style="color: green;"></i>
                        @else
                            <i class="fas fa-times-circle" style="color: red;"></i>
                        @endif
                        <b>EI:</b>{{ $v1_stats_from_php[$id]['EI'] }}
                    </div>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <h1>IMET v2</h1>
    <table class="striped">
        <thead>
            <tr>
                <th>assessment ID</th>
                <th>radar from DB</th>
                <th>radar from PHP</th>
            </tr>
        </thead>
        <tbody>
        @foreach($assessments_v2 as $id)
            <tr>
                <td>{{ $id }}</td>
                <td>
                    <div><b>C:</b> {{ $v2_stats_from_db[$id]['C'] }}</div>
                    <div><b>P:</b> {{ $v2_stats_from_db[$id]['P'] }}</div>
                    <div><b>I:</b> {{ $v2_stats_from_db[$id]['I'] }}</div>
                    <div><b>PR:</b> {{ $v2_stats_from_db[$id]['PR'] }}</div>
                    <div><b>R:</b> {{ $v2_stats_from_db[$id]['OP'] }}</div>
                    <div><b>EI:</b> {{ $v2_stats_from_db[$id]['OC'] }}</div>
                </td>
                <td>
                    <div>
                        @if($v2_stats_from_db[$id]['C'] === $v2_stats_from_php[$id]['C'])
                            <i class="fas fa-check-circle" style="color: green;"></i>
                        @else
                            <i class="fas fa-times-circle" style="color: red;"></i>
                        @endif
                        <b>C:</b> {{ $v2_stats_from_php[$id]['C'] }}
                    </div>
                    <div>
                        @if($v2_stats_from_db[$id]['P'] === $v2_stats_from_php[$id]['P'])
                            <i class="fas fa-check-circle" style="color: green;"></i>
                        @else
                            <i class="fas fa-times-circle" style="color: red;"></i>
                        @endif
                        <b>P:</b> {{ $v2_stats_from_php[$id]['P'] }}
                    </div>
                    <div>
                        @if($v2_stats_from_db[$id]['I'] === $v2_stats_from_php[$id]['I'])
                            <i class="fas fa-check-circle" style="color: green;"></i>
                        @else
                            <i class="fas fa-times-circle" style="color: red;"></i>
                        @endif
                        <b>I:</b> {{ $v2_stats_from_php[$id]['I'] }}
                    </div>
                    <div>
                        @if($v2_stats_from_db[$id]['PR'] === $v2_stats_from_php[$id]['PR'])
                            <i class="fas fa-check-circle" style="color: green;"></i>
                        @else
                            <i class="fas fa-times-circle" style="color: red;"></i>
                        @endif
                        <b>PR:</b> {{ $v2_stats_from_php[$id]['PR'] }}
                    </div>
                    <div>
                        @if($v2_stats_from_db[$id]['OP'] === $v2_stats_from_php[$id]['OP'])
                            <i class="fas fa-check-circle" style="color: green;"></i>
                        @else
                            <i class="fas fa-times-circle" style="color: red;"></i>
                        @endif
                        <b>R:</b> {{ $v2_stats_from_php[$id]['OP'] }}
                    </div>
                    <div>
                        @if($v2_stats_from_db[$id]['OC'] === $v2_stats_from_php[$id]['OC'])
                            <i class="fas fa-check-circle" style="color: green;"></i>
                        @else
                            <i class="fas fa-times-circle" style="color: red;"></i>
                        @endif
                        <b>EI:</b> {{ $v2_stats_from_php[$id]['OC'] }}
                    </div>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

@endsection