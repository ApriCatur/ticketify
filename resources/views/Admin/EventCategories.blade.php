@tbody class="divide-y divide-white/5">

    @php
        $categoryColors = [
            'Entertainment' => 'bg-purple-500/20 text-purple-400',
            'Sports'        => 'bg-green-500/20 text-green-400',
            'Education'     => 'bg-yellow-500/20 text-yellow-400',
            'Business'      => 'bg-blue-500/20 text-blue-400',
            'Exhibitions'   => 'bg-pink-500/20 text-pink-400',
        ];
        $categoryIcons = [
            'Entertainment' => 'fa-star',
            'Sports'        => 'fa-trophy',
            'Education'     => 'fa-graduation-cap',
            'Business'      => 'fa-briefcase',
            'Exhibitions'   => 'fa-image',
        ];
    @endphp

    @foreach ($categoriesData as $i => $item)
        @php
            $categoryName = $item->category ?? 'Uncategorized';
            $color = $categoryColors[$categoryName] ?? 'bg-gray-500/20 text-gray-300';
            $icon  = $categoryIcons[$categoryName] ?? 'fa-tag';
        @endphp
        <tr class="hover:bg-white/5 transition-colors">
            <td class="py-4 text-gray-500 text-sm">{{ $i + 1 }}</td>
            <td class="py-4">
                <div class="flex items-center gap-3">
                    <div class="w-8 h-8 rounded-lg flex items-center justify-center text-xs {{ $color }}">
                        <i class="fa-solid {{ $icon }}"></i>
                    </div>
                    <span class="font-medium text-sm text-white">{{ $categoryName }}</span>
                    <span class="text-xs text-gray-500">({{ $item->total }} Events)</span>
                </div>
            </td>
            <td class="py-4">
                <div class="flex justify-center gap-2">
                    <button onclick="openEditCategory('{{ $categoryName }}')"
                        class="flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-blue-500/10 text-blue-400 hover:bg-blue-500/20 transition-colors text-xs font-semibold">
                        <i class="fa-solid fa-pen-to-square text-[11px]"></i> Edit
                    </button>
                    <button onclick="openDeleteCategory('{{ $categoryName }}')"
                        class="flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-red-500/10 text-red-400 hover:bg-red-500/20 transition-colors text-xs font-semibold">
                        <i class="fa-solid fa-trash text-[11px]"></i> Delete
                    </button>
                </div>
            </td>
        </tr>
    @endforeach

</tbody>
