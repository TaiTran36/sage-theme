@extends('layouts.app')
@section('content')
  <div class="w-full min-h-screen flex items-center justify-center bg-gray-100">
    <div class="bg-white p-8 rounded shadow-md max-w-5xl w-full text-center">
      <div class="flex flex-col md:flex-row justify-between items-center">
        <div class="flex flex-col md:flex-row gap-4 w-full md:w-auto">
          <div class="px-2 py-1 bg-gray-100 text-black rounded-md">Tất cả</div>
          <div class="px-2 py-1 bg-red-500 text-white rounded-md flex items-center justify-center gap-1">
            <div class="flex justify-center w-4 h-4">
              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" strokeWidth={1.5} stroke="currentColor" className="w-5 h-5 text-white">
                <path strokeLinecap="round" strokeLinejoin="round" d="M9.348 14.652a3.75 3.75 0 0 1 0-5.304m5.304 0a3.75 3.75 0 0 1 0 5.304m-7.425 2.121a6.75 6.75 0 0 1 0-9.546m9.546 0a6.75 6.75 0 0 1 0 9.546M5.106 18.894c-3.808-3.807-3.808-9.98 0-13.788m13.788 0c3.808 3.807 3.808 9.98 0 13.788M12 12h.008v.008H12V12Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
              </svg>
            </div>
            <div>Trực tiếp {{'(' . $counter . ')'}}</div>
          </div>
          <div class="px-2 py-1 bg-gray-100 text-black rounded-md">Đã kết thúc</div>
          <div class="px-2 py-1 bg-gray-100 text-black rounded-md">Lịch thi đấu</div>
        </div>
        <div class="mt-4 md:mt-0 w-full md:w-auto">
          <div class="flex flex-row gap-1 border rounded-md px-1 py-1 items-center justify-center">
            <input type="checkbox">
            <span>Xếp theo tên</span>
          </div>
        </div>
      </div>
      <div class="list-results">
        <table class="table-auto border-collapse mt-6">
          @if($groupMatches)
            @foreach($groupMatches as $group)
              @php
                $country_logo = sizeof($group) > 0 ? ($group[0]['country_logo'] ?? 'logo') : 'logo';
                $country_name = sizeof($group) > 0 ? ($group[0]['country_name'] ?? '') : '';
                $competition_name = sizeof($group) > 0 ? ($group[0]['competition']['name'] ?? '') : '';
              @endphp
              <thead class="bg-gray-200">
              <tr>
                <th class="px-4 py-2 w-8 text-center">
                  <div class="flex justify-center">
                    <svg
                      xmlns="http://www.w3.org/2000/svg"
                      fill="none"
                      viewBox="0 0 24 24"
                      stroke-width="1.5"
                      stroke="currentColor"
                      class="w-4 h-4"
                    >
                      <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M11.48 3.499a.562.562 0 0 1 1.04 0l2.125 5.111a.563.563 0 0 0 .475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 0 0-.182.557l1.285 5.385a.562.562 0 0 1-.84.61l-4.725-2.885a.562.562 0 0 0-.586 0L6.982 20.54a.562.562 0 0 1-.84-.61l1.285-5.386a.562.562 0 0 0-.182-.557l-4.204-3.602a.562.562 0 0 1 .321-.988l5.518-.442a.563.563 0 0 0 .475-.345L11.48 3.5Z"
                      />
                    </svg>
                  </div>
                </th>
                <th colSpan="9" class="px-4 py-2 text-center">
                  <div class="flex gap-1 items-center">
                    <div class="h4 w-4">
                      <img src="@asset('images/' . $country_logo . '.png')" alt="{{ $country_logo }}" class="w-4 h-4 block" />
                    </div>
                    <div><span class="text-gray-600">{{$country_name . ': '}}</span><span>{{$competition_name}}</span></div>
                  </div>
                </th>
              </tr>
              </thead>
              <tbody>
              @foreach($group as $match)
                <tr>
                  <td class="px-4 py-2 w-8 text-center">
                    <div class="flex justify-center">
                      <svg
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke-width="1.5"
                        stroke="currentColor"
                        class="w-4 h-4"
                      >
                        <path
                          stroke-linecap="round"
                          stroke-linejoin="round"
                          d="M11.48 3.499a.562.562 0 0 1 1.04 0l2.125 5.111a.563.563 0 0 0 .475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 0 0-.182.557l1.285 5.385a.562.562 0 0 1-.84.61l-4.725-2.885a.562.562 0 0 0-.586 0L6.982 20.54a.562.562 0 0 1-.84-.61l1.285-5.386a.562.562 0 0 0-.182-.557l-4.204-3.602a.562.562 0 0 1 .321-.988l5.518-.442a.563.563 0 0 0 .475-.345L11.48 3.5Z"
                        />
                      </svg>
                    </div>
                  </td>
                  <td class="px-4 py-2 border-b text-gray-400">{{\App\Helpers\Common::convertTimeStart($match['match_time'])}}</td>
                  <td class="px-4 py-2 border-b text-red-500">{{\App\Helpers\Common::convertTimeMatch($match['match_time'], $match['status_id'])}}</td>
                  <td class="px-4 py-2 pr-0 border-b">
                    <div class="flex justify-end gap-1">
                      <div>{{$match['home_team']['name']}}</div>
                    </div>
                  </td>
                  <td class="py-2 border-b">
                    <div>
                      <img src="@asset('images/' . $match['home_team']['logo'])" alt="{{ $match['home_team']['logo'] }}" class="w-5 h-5 block" />
                    </div>
                  </td>
                  <td class="px-4 py-2 border-b text-red-500">
                    {{json_decode($match['home_scores'], true)[0] . '-' . json_decode($match['away_scores'], true)[0]}}
                  </td>
                  <td class="py-2 border-b">
                    <div>
                      <img src="@asset('images/' . $match['away_team']['logo'])" alt="{{ $match['away_team']['logo'] }}" class="w-5 h-5 block" />
                    </div>
                  </td>
                  <td class="px-4 py-2 pl-0 border-b">
                    <div class="flex justify-start gap-1">
                      <div>{{$match['away_team']['name']}}</div>
                    </div>
                  </td>
                  <td class="px-4 py-2 border-b text-gray-400">HT {{json_decode($match['home_scores'], true)[1] . ' - ' . json_decode($match['away_scores'], true)[1]}}</td>
                  <td class="py-2 border-b">
                    <div class="flex justify-center items-center gap-1">
                      <div>
                        <img src="@asset('images/corner_kick.png')" alt="corner kick" class="w-5 h-5 block" />
                      </div>
                      <div class="text-gray-400">{{(json_decode($match['home_scores'], true)[4] > 0 ?: 0) . ' - ' . (json_decode($match['away_scores'], true)[4] > 0 ?: 0)}}</div>
                    </div>
                  </td>
                </tr>
              @endforeach
              </tbody>
            @endforeach
          @endif
        </table>
      </div>
    </div>
  </div>
@endsection
