<x-app-layout>
    <!-- Notification Dropdown in Header -->
    <!-- You can include this snippet in your main layout (e.g., resources/views/layouts/app.blade.php) or directly in each view's header -->
    <!-- Example integration in the header nav -->
    <!-- If you have a separate layout file, place the following inside the <nav> element -->
    <!-- Notification Badge -->
    <div x-data="{ open: false, unreadCount: 0 }" x-init="
        fetch('{{ route('notifications.unread-count') }}')
            .then(res => res.json())
            .then(data => unreadCount = data.count)
    " class="relative ml-4">
        <button @click="open = !open" class="flex items-center text-gray-700 hover:text-gray-900">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6 6 0 00-5-5.917V5a3 3 0 10-6 0v.083A6 6 0 002 11v3.159c0 .538-.214 1.055-.595 1.436L0 17h5m10 0a3 3 0 11-6 0h6z" />
            </svg>
            <span x-show="unreadCount > 0" class="absolute -top-1 -right-1 bg-red-600 text-white rounded-full text-xs w-4 h-4 flex items-center justify-center">{{ unreadCount }}</span>
        </button>
        
        <!-- Dropdown -->
        <div x-show="open" @click.away="open = false" class="absolute right-0 mt-2 w-64 bg-white rounded-md shadow-lg z-20">
            <div class="p-2">
                <h3 class="text-sm font-semibold text-gray-800 mb-2">Notifikasi</h3>
                <div x-data="{ notifications: [] }" x-init="
                    fetch('{{ route('notifications.index') }}')
                        .then(res => res.json())
                        .then(data => notifications = data.notifications)
                ">
                    <template x-for="notification in notifications" :key="notification.id">
                        <<div class="flex items-start space-x-2 p-2 hover:bg-gray-100 rounded">
                            <div class="flex-shrink-0">
                                <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3" />
                                </svg>
                            </div>
                            <div class="flex-1">
                                <a :href="notification.data.action_url" class="block text-sm text-gray-800">
                                    <strong class="font-medium">{{ notification.data.sender_name ?? notification.data.receiver_name }}</strong> {{ notification.data.message }}
                                </a>
                                <span class="text-xs text-gray-500">{{ new Date(notification.created_at).toLocaleString() }}</span>
                            </div>
                        </div>
                    </template>
                    <div x-show="notifications.length === 0" class="p-2 text-sm text-gray-500">Tidak ada notifikasi</div>
                </div>
                <!-- Mark all as read -->
                <<div class="text-right mt-2">
                    <a href="{{ route('notifications.mark-all-read') }}" class="text-xs text-blue-600 hover:underline">Tandai semua telah dibaca</a>
                </div>
            </div>
        </div>
    </div>
    <!-- End Notification Dropdown -->
</x-app-layout>