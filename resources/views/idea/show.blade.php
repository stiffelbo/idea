<x-layout>
    <div class="py-8 max-w-4xl mx-auto">
        <div class="flex justify-between items-center ">
            <a href="{{route('idea.index')}}" class="btn btn-outlined ">
                Back to Ideas
            </a>
            <div class="gap-x-3 flex items-center">
                <button
                    class="btn btn-outlined text-blue-500  border-blue-500/70"
                >
                    Edit Idea
                </button>
                <form action="{{route('idea.destroy', $idea)}}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button
                        type="submit"
                        class="btn btn-outlined text-red-500  border-red-500/70"
                    >
                        Delete Idea
                    </button>
                </form>

            </div>
        </div>
        <div class="mt-6 space-y-3">
            <h1 class="font-bold text-2xl mt-4">{{$idea->title}}</h1>
            <div class="mt-3 flex gap-x-3 items-center">
                <x-idea.status-label status="{{$idea->status->value}}">{{$idea->status->label()}}</x-idea.status-label>
                <div class="text-muted-foreground text-sm">
                    {{$idea->updated_at->diffForHumans()}}
                </div>
            </div>
            <x-card class="mt-4">
                <div class="text-foreground max-w-none cursor-pointer">
                    {{$idea->description}}
                </div>
            </x-card>
            @if(!empty($idea->links))
                <div>
                    <h3>Links</h3>
                    <div class="mt-2 space-y-2">
                        @foreach($idea->links as $link)
                            <x-card href="{{$link}}" class="text-primary font-medium flex gap-x-3 items-center">
                                {{$link}}
                            </x-card>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-layout>
