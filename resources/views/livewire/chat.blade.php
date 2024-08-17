<div>
    <div wire:poll.2s="loadMessages">
        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white rounded-lg">
                    <div class="p-6">
                        <div id="messages-container" class="pr-4 mb-4 space-y-4 overflow-y-auto h-96" x-data="chatbox()" x-init="init()" x-ref="messagesContainer">
                            @foreach ($messages as $message)
                                <div class="flex {{ $message['from'] == Auth::id() ? 'justify-end' : 'justify-start' }}">
                                    <div class="max-w-xs w-full {{ $message['from'] == Auth::id() ? 'bg-blue-500 text-white' : 'bg-gray-200 text-gray-800' }} p-3 rounded-lg break-words">
                                        <strong>{{ $message['from'] == Auth::id() ? Auth::user()->name . ' (You)' : $user->name }}:</strong>
                                        <p>{{ $message['message'] }}</p>
                                        @if ($message['from'] != Auth::id() && !$message['is_read'])
                                            <script>
                                                Livewire.emit('markAsRead', {{ $message['id'] }});
                                            </script>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <form wire:submit.prevent="sendMessage" class="flex items-center mt-4 space-x-4">
                            <div class="relative flex-grow">
                                <textarea
                                    wire:model.defer="message"
                                    rows="1"
                                    x-data
                                    x-autosize
                                    @keydown.enter.prevent="if (!event.shiftKey) { $dispatch('submit'); }"
                                    @keydown.shift.enter="event.stopPropagation()"
                                    class="block w-full p-2 mt-1 bg-gray-100 border border-gray-300 rounded-lg resize-none focus:outline-none focus:ring-2 focus:ring-blue-500"
                                    placeholder="Write something incredible..."
                                    id="messageInput"
                                ></textarea>
                            </div>
                            <button type="submit" class="px-4 py-2 text-white bg-blue-600 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">Send</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <script>
            function chatbox() {
                return {
                    init() {
                        this.scrollToBottom();
                        Livewire.on('messageAdded', () => {
                            this.scrollToBottom();
                        });
                        Livewire.on('maintainScrollPosition', (event) => {
                            this.$refs.messagesContainer.scrollTop = this.$refs.messagesContainer.scrollHeight - event.previousHeight;
                        });
                        Livewire.on('updateMessageBubble', (tempMessageId, messageContent) => {
                            const tempMessage = document.getElementById(tempMessageId);
                            if (tempMessage) {
                                tempMessage.innerHTML = `
                                    <div class="w-full max-w-xs p-3 text-white break-words bg-blue-500 rounded-lg">
                                        <strong>{{ Auth::user()->name }} (You):</strong>
                                        <p>${messageContent}</p>
                                    </div>
                                `;
                            }
                        });
                    },
                    scrollToBottom() {
                        this.$refs.messagesContainer.scrollTop = this.$refs.messagesContainer.scrollHeight;
                    },
                    loadMoreMessages() {
                        const previousHeight = this.$refs.messagesContainer.scrollHeight;
                        @this.call('loadMoreMessages', previousHeight);
                    },
                    observe() {
                        let observer = new IntersectionObserver((entries) => {
                            entries.forEach(entry => {
                                if (entry.isIntersecting) {
                                    this.loadMoreMessages();
                                }
                            });
                        }, {
                            root: this.$refs.messagesContainer,
                            rootMargin: '0px',
                            threshold: 0.1
                        });
                        observer.observe(this.$refs.topOfMessages);
                    }
                }
            }

            document.addEventListener('DOMContentLoaded', function () {
                const messageInput = document.getElementById('messageInput');
                const messagesContainer = document.getElementById('messages-container');

                messageInput.addEventListener('keydown', function (event) {
                    if (event.key === 'Enter' && !event.shiftKey) {
                        event.preventDefault();
                        const messageContent = messageInput.value;
                        const tempMessageId = 'temp-' + Date.now();
                        const tempMessage = document.createElement('div');
                        tempMessage.id = tempMessageId;
                        tempMessage.className = 'flex justify-end';
                        tempMessage.innerHTML = `
                            <div class="w-full max-w-xs p-3 text-white break-words bg-gray-300 rounded-lg">
                                <strong>{{ Auth::user()->name }} (You):</strong>
                                <p>${messageContent}</p>
                            </div>
                        `;
                        messagesContainer.appendChild(tempMessage);
                        messagesContainer.scrollTop = messagesContainer.scrollHeight;

                        @this.call('sendMessage', messageContent, tempMessageId);
                        messageInput.value = '';
                    }
                });

                // Scroll to the bottom of the messages container on page load
                messagesContainer.scrollTop = messagesContainer.scrollHeight;

                // Scroll to the bottom when a new message is added
                Livewire.on('messageAdded', () => {
                    messagesContainer.scrollTop = messagesContainer.scrollHeight;
                });

                // Maintain scroll position when more messages are loaded
                Livewire.on('maintainScrollPosition', (event) => {
                    messagesContainer.scrollTop = messagesContainer.scrollHeight - event.previousHeight;
                });

                // Update the temporary message bubble to the final one
                Livewire.on('updateMessageBubble', (tempMessageId, messageContent) => {
                    const tempMessage = document.getElementById(tempMessageId);
                    if (tempMessage) {
                        tempMessage.innerHTML = `
                            <div class="w-full max-w-xs p-3 text-white break-words bg-blue-500 rounded-lg">
                                <strong>{{ Auth::user()->name }} (You):</strong>
                                <p>${messageContent}</p>
                            </div>
                        `;
                    }
                });

            });
        </script>
    </div>
</div>
