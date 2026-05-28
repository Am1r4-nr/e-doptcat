<x-admin-layout>
    <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
        <div class="flex justify-between items-center mb-6">
            <h2 class="font-jakarta text-3xl font-extrabold text-[#1C1A17] tracking-tight">
                Report Details
            </h2>
            <a href="{{ route('admin.reports.index') }}"
                class="text-blue-600 hover:text-blue-900">← Back to List</a>
        </div>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div class="grid grid-cols-2 gap-6 mb-6">
                    <div>
                        <p class="text-sm text-gray-600">Report Type</p>
                        <p class="text-lg font-medium">{{ $report->type }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600">Reporter</p>
                        <p class="text-lg font-medium">{{ $report->user->name }}</p>
                    </div>
                </div>

                <div class="mb-6">
                    <p class="text-sm text-gray-600">Status</p>
                    <p class="mt-2">
                        <form action="{{ route('admin.reports.status', $report) }}" method="POST" class="inline-flex gap-2">
                            @csrf
                            @method('PATCH')
                            <select name="status" onchange="this.form.submit()"
                                class="rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                <option value="Pending" {{ $report->status === 'Pending' ? 'selected' : '' }}>Pending</option>
                                <option value="Resolved" {{ $report->status === 'Resolved' ? 'selected' : '' }}>Resolved</option>
                                <option value="Closed" {{ $report->status === 'Closed' ? 'selected' : '' }}>Closed</option>
                            </select>
                        </form>
                    </p>
                </div>

                <div>
                    <p class="text-sm text-gray-600">Description</p>
                    <p class="mt-2 text-gray-700">{{ $report->description ?? 'No description provided.' }}</p>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
