@props(['options' => null, 'selected' => null])

<select {{ $attributes->merge(['class' => 'border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm transition']) }}>
    <option value="" disabled @selected(is_null($selected))>Select</option>

    @empty($options)
        {{ $slot }}
    @else
        @foreach($options as $option)
            <option value="{{ $option['value'] }}">{{ $option['label'] }}</option>
        @endforeach
    @endempty
</select>
