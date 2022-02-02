<div>
  <div class="container mx-auto">

    <div class="shadow p-8 mt-16">
      <h1 class="text-black text-2xl font-bold mb-2">Kobalt's Stage Challenge</h1>

      <textarea wire:model="text" placeholder="John" class="w-full border border-gray-400 rounded p-4" rows="8"></textarea>

      @if ($output->count())
      <ul class="space-y-10 mt-10">
        @foreach ($output as $item)
          <li class="flex space-x-4">
            <strong class="w-16">{{ $item->name }}</strong>
            <ul class="flex space-x-3 w-full justify-end">
              @foreach ($item->alphabet as $letter)
                <li class="w-12">
                  <span class="text-gray-600">
                    {{ $letter->letter }}
                  </span>
                  {{ $letter->value }}
                </li>
                @if(!$loop->last)
                  <li>
                    +
                  </li>
                @else
                  <li>
                    =
                  </li>
                @endif
              @endforeach
            </ul>
            <div class="justify-self-end w-48 flex justify-end">
              <span class="w-8">
                {{ $item->total }}
              </span>
              <span class="w-4">
                x
              </span>
              <span  class="w-4">
                {{ $loop->index + 1 }}
              </span>
              <span class="w-8 mx-2">
                =
              </span>
              <span  class="w-12 text-right">
                {{ $item->totalWithPosition }}
              </span>
            </div>
          </li>
        @endforeach
      </ul>
      @endif
      @if ($total > 0)
        <div class="w-full flex justify-end mt-10">
          {{ $total }}
        </div>
      @endif
    </div>
  </div>
</div>
