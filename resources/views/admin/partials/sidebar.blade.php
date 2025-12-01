<aside class="w-64 bg-white border-r border-gray-200 flex flex-col py-8 px-0 h-screen sticky top-0 shadow-sm">
    <div class="mb-10 px-6">
        <div class="text-2xl font-extrabold text-gray-800 tracking-tight text-center">Admin Panel</div>
    </div>
    <nav class="flex-1">
        <ul class="space-y-1">
            <li>
                <a href="{{ route('admin.paintings.index') }}" class="flex items-center gap-3 py-2.5 px-6 rounded-lg transition font-medium {{ request()->is('admin/lukisan*') ? 'bg-gray-900 text-white shadow' : 'text-gray-700 hover:bg-gray-100' }}">
                    <span>🎨</span>
                    <span>Lukisan</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.surveys.index') }}" class="flex items-center gap-3 py-2.5 px-6 rounded-lg transition font-medium {{ request()->is('admin/surveys*') ? 'bg-gray-900 text-white shadow' : 'text-gray-700 hover:bg-gray-100' }}">
                    <span>📝</span>
                    <span>Survey</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.users.index') }}" class="flex items-center gap-3 py-2.5 px-6 rounded-lg transition font-medium {{ request()->is('admin/users*') ? 'bg-gray-900 text-white shadow' : 'text-gray-700 hover:bg-gray-100' }}">
                    <span>👤</span>
                    <span>Users</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.comments.index') }}" class="flex items-center gap-3 py-2.5 px-6 rounded-lg transition font-medium {{ request()->is('admin/comments*') ? 'bg-gray-900 text-white shadow' : 'text-gray-700 hover:bg-gray-100' }}">
                    <span>💬</span>
                    <span>Comments</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.settings.index') }}" class="flex items-center gap-3 py-2.5 px-6 rounded-lg transition font-medium {{ request()->is('admin/settings*') ? 'bg-gray-900 text-white shadow' : 'text-gray-700 hover:bg-gray-100' }}">
                    <span>⚙️</span>
                    <span>Settings</span>
                </a>
            </li>
        </ul>
    </nav>
    <div class="mt-10 px-6">
        <a href="/" class="block text-xs text-gray-400 hover:text-gray-700 text-center">← Kembali ke Website</a>
    </div>
</aside>