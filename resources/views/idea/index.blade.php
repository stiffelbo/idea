<x-layout>
    <div class="">
        <header class="py-8 md:py-12">
            <h1 class="text-3xl font-bold">Ideas</h1>
            <p class="text-muted-foreground text-sm mt-2">Capture your thoughts. Make a plan</p>
            <x-card
                x-data
                @click="$dispatch('open-modal', 'create-idea')"
                is="button"
                type="button"
                class="mt-4 h-32 w-full"
                data-test="create-idea-button"
            >
                <p>Whats the idea?</p>
            </x-card>
        </header>
        <div>
            <a href="/ideas" class="btn {{request()->has('status') ? 'btn-outlined' : 'bg-amber-500'}}">
                All
                <span class="text-xs pl-0.5">{{$statusCounts->get('all')}}</span>
            </a>
            @foreach(\App\IdeaStatus::cases() as $status)
                <a
                    href="/ideas?status={{$status->value}}"
                    class="btn {{request('status') === $status->value ? '' : 'btn-outlined'}}"
                >
                        {{$status->label()}}
                        <span class="text-xs pl-0.5">{{$statusCounts->get($status->value)}}</span>
                </a>
            @endforeach
        </div>
        <div class="mt-10 text-muted-foreground">
            <div class="mt-10 grid gap-6 md:grid-cols-2 lg:grid-cols-3 ">
                @forelse($ideas as $idea)
                    <x-card href="{{route('idea.show', $idea)}}">
                        <h3 class="text-foreground text-lg">{{$idea->title}}</h3>
                        <div class="mt-2">
                            <x-idea.status-label status="{{$idea->status}}">
                                {{$idea->status->label()}}
                            </x-idea.status-label>
                        </div>
                        <div class="mt-5 line-clamp-3">
                            {{$idea->description}}
                        </div>
                        <div class="mt-4">
                            {{$idea->created_at->diffForHumans()}}
                        </div>
                    </x-card>
                @empty
                    <x-card>
                        <p class="text-muted-foreground">No ideas</p>
                    </x-card>
                @endforelse
            </div>
        </div>
        <!-- modal -->
        <x-modal name="create-idea" title="New Idea">
            <x-card @click.away="show = false" class="w-7xl shadow-xl max-h-[80dvh] overflow-auto">
                <div class="flex justify-between">
                    <h1>Add Idea</h1>
                    <button class="btn btn-outlined text-red-500 bg-red-500/10 border-red-500" @click="show = false">
                        Close
                    </button>
                </div>
                <form
                    x-data="{
                        status : 'pending',
                        newLink: '',
                        links: [],
                    }"
                    action="{{route('idea.store')}}"
                    method="POST"
                >
                    @csrf
                    <div class="space-y-6">
                        <x-form.input
                            name="title"
                            label="Title"
                            required
                        />
                        <div>
                            <label class="label">Status</label>

                            <div class="flex flex-wrap gap-2 mt-4">
                                @foreach(App\IdeaStatus::cases() as $s)
                                   <button
                                        type="button"
                                        @click="status = @js($s->value)"
                                        class="btn flex-1 h10"
                                        data-test="button-status-{{$s->value}}"
                                        :class="{'btn-outlined' : status !== @js($s->value)}">
                                       {{$s->label()}}
                                   </button>
                                @endforeach
                                <input type="hidden" :value="status" name="status" />
                            </div>
                        </div>
                        <x-form.input
                            name="description"
                            label="What's the idea?"
                            type="textarea"
                        />

                    </div>

                    <div class="mt-2">
                        <fieldset class="space-y-3">
                            <legend class="label">Links</legend>
                            <template x-for="(link, index) in  links" :key="link">
                                <div class="flex gap-x-2 item-center">
                                    <input type="text" name="links[]" x-model="link" class="flex-1" readonly>
                                    <button
                                        type="button"
                                        class="btn btn-outlined"
                                        @click="links.splice(index, 1)"
                                        aria-label="remove link button"
                                    >
                                        -
                                    </button>
                                </div>
                            </template>
                            <div class="flex gap-x-2 item-center">
                                <input
                                    x-model="newLink"
                                    type="url"
                                    id="new-link"
                                    placeholder="http://example.com"
                                    autocomplete="url"
                                    class="input flex-1"
                                    spellcheck="false"
                                    data-test="newLink"
                                >
                                <button
                                    type="button"
                                    class="btn btn-outlined h-10"
                                    @click="links.push(newLink.trim()); newLink = ''"
                                    :disabled="newLink.trim().length === 0"
                                    aria-label="Add link button"
                                    data-test="add-newLink"
                                >
                                    +
                                </button>
                            </div>
                        </fieldset>

                        <div class="flex justify-end gap-x-5 mt-4">
                            <button type="button" class="btn btn-outlined text-red-500 bg-red-500/10 border-red-500" @click="show = false">
                                Cancel
                            </button>
                            <button
                                type="submit"
                                data-test="create-idea"
                                class="btn"
                            >Create
                            </button>
                        </div>
                    </div>
                </form>
            </x-card>
        </x-modal>
    </div>
</x-layout>
