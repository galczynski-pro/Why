<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Chat with {{ $persona['name'] ?? 'Why' }}
            </h2>
            @if(!empty($persona))
                <span class="text-sm text-gray-500">v{{ $persona['version'] ?? '1.0' }}</span>
            @endif
        </div>
    </x-slot>

    <div class="py-6" x-data="chatUI()">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="h-96 overflow-y-auto border rounded-md p-4 space-y-4 bg-gray-50" id="messages">
                        <template x-for="(m, i) in messages" :key="i">
                            <div :class="m.role === 'user' ? 'text-right' : 'text-left'">
                                <div :class="m.role === 'user' ? 'inline-block bg-blue-600 text-white' : 'inline-block bg-gray-200 text-gray-800'" class="px-3 py-2 rounded-lg max-w-[80%]">
                                    <span x-text="m.content"></span>
                                </div>
                            </div>
                        </template>
                        <template x-if="messages.length === 0">
                            <div class="text-gray-500 text-center">Say hello to {{ $persona['name'] ?? 'Why' }} and ask a question!</div>
                        </template>
                    </div>

                    <form class="mt-4 flex gap-2" @submit.prevent="send()">
                        <input x-model="draft" type="text" class="flex-1 border rounded-md px-3 py-2 focus:outline-none focus:ring focus:ring-blue-300" placeholder="Type your message..." />
                        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 disabled:opacity-50" :disabled="sending || !draft.trim()">
                            <span x-show="!sending">Send</span>
                            <span x-show="sending">Sending...</span>
                        </button>
                    </form>

                    <p class="mt-2 text-xs text-gray-500">Note: Backend chat API not connected yet. This UI locally simulates a reply for now.</p>
                </div>
            </div>
        </div>
    </div>

    <script>
        function chatUI() {
            return {
                messages: [],
                draft: '',
                sending: false,
                send() {
                    const text = this.draft.trim();
                    if (!text) return;
                    this.messages.push({ role: 'user', content: text });
                    this.draft = '';
                    this.sending = true;

                    // Simulated assistant reply for now
                    const name = @json($persona['name'] ?? 'Why');
                    setTimeout(() => {
                        this.messages.push({
                            role: 'assistant',
                            content: `**${name}**: That's a lovely question! Let's explore it together.`
                        });
                        this.$nextTick(() => {
                            const box = document.getElementById('messages');
                            box.scrollTop = box.scrollHeight;
                        });
                        this.sending = false;
                    }, 500);
                }
            }
        }
    </script>
</x-app-layout>