<div class="flex flex-grow">
    <div class="w-full max-w-3xl m-auto flex flex-col text-white">
        <div class="bg-panel-1000 w-full px-6 py-4 flex flex-col rounded-xl">
            <div class="md:flex justify-between items-center pb-3 ">
                <div class="mb-2 mr-4 md:mb-0 md:flex-1">
                    <input
                        class=" bg-transparent w-full font-bold text-sm placeholder:text-white  focus:ring-0 focus:outline-none"
                        placeholder="Add a Title" type="text">
                </div>
                <div class="relative w-full md:w-fit inline-block text-left" x-data="{ show: false }" x-cloak>
                    <div
                        class="relative bg-blue-1300 hover:bg-blue-1400 h-full flex items-center rounded-xl  overflow-hidden">
                        <select required
                            class="w-full h-8 font-medium pl-4 pr-8 text-xs rounded-md bg-transparent focus:border-none focus:outline-none"
                            name="topic" id="topic">
                            <option disabled selected hidden class="bg-slate-800 hover:bg-blue-1200" value>Select Topic
                            </option>
                            @if ($topics != null && $topics->count() > 0)
                                @foreach ($topics as $topic)
                                    <option class="bg-slate-800 hover:bg-blue-1200" value={{ $topic->id }}>
                                        {{ $topic->name }}
                                    </option>
                                @endforeach
                            @else
                                <option disabled>No topics available</option>
                            @endif
                        </select>
                        <svg width="18" height="16" class="fill-current pointer-events-none absolute"
                            viewBox="0 0 10 16" style="right: 10px;">
                            <path d="M5 11L0 6l1.5-1.5L5 8.25 8.5 4.5 10 6z"></path>
                        </svg>
                    </div>
                </div>
            </div>
            <hr class="w-full border-b-[0.5] border-gray-500" />
            <textarea
                class="bg-transparent mb-1 border-none px-0 py-4 text-sm min-h-[175px] max-h-[45vh] break-words resize-none font-medium outline-none overflow-x-hidden overflow-y-auto"
                placeholder="What's on your mind?" name="" id="" cols="30" rows="10"></textarea>
            <hr class="w-full border-b-[0.5] border-gray-500" />
            <div class="w-full flex justify-end mt-4">
                <div class="w-full md:w-fit flex text-sm font-semibold gap-4">
                    <button
                        class="w-full md:w-fit px-12 py-4 md:py-3 rounded-xl bg-blue-1300 hover:bg-blue-1400">Cancel</button>
                    <button class="w-full md:w-fit px-12 py-4 md:py-3 rounded-xl btn-blue-hover">Post</button>
                </div>
            </div>
        </div>
    </div>
</div>
