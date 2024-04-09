<div>
    <table class="table table-xs table-zebra-zebra">
        <thead class="bg-primary">
            <tr class="text-center">
                
                
                <th>{{ __('Date') }}</th>
                <th>{{ __('Company Category') }}</th>
                <th>{{ __('Company') }}</th>
                <th>{{ __('Department') }}</th>
                <th>{{ __('Dept Group') }}</th>
                <th>{{ __('Job Class') }}</th>
                <th>{{ __('Manhours') }}</th>
                <th>{{ __('Manpower') }}</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($ManhoursRegister as $index =>$item)
            <tr class="text-center">
               
                <td>{{ date('M-Y',strtotime($item->date)) }}</td>
                <td>{{$item->company_category}}</td>
                <td>{{$item->company}}</td>
                <td>{{$item->dept}}</td>
                <td>{{$item->group}}</td>
                <td>{{$item->role_class}}</td>
                <td>{{(int)$item->manhour}}</td>
                <td>{{$item->manpower}}</td>
               
            </tr>
        @empty
            <tr>
                <td colspan="10" class="font-semibold text-rose-500">

                    <p class="flex justify-center"> Data not found <span
                            class="loading loading-bars loading-xs"> </span></p>
                </td>
            </tr>
        @endforelse
        </tbody>
       
    </table>
</div>
