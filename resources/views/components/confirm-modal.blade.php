@props([
    'confirmText' => 'TripsHub',
])

<div id="confirm-modal-overlay" class="fixed inset-0 overflow-y-auto px-4 py-6 sm:px-0 z-50 hidden">
    <div class="fixed inset-0 transform transition-all" onclick="hideConfirmModal()">
        <div class="absolute inset-0 bg-black/60 backdrop-blur-sm"></div>
    </div>

    <div class="mb-6 card p-6 overflow-hidden shadow-elevated transform transition-all sm:w-full sm:max-w-md sm:mx-auto" style="margin-top: 8vh;">
        <div class="text-center mb-6">
            <div class="w-14 h-14 rounded-full bg-coral/10 flex items-center justify-center mx-auto mb-4">
                <svg class="w-7 h-7 text-coral-light" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4.5c-.77-.833-2.694-.833-3.464 0L3.34 16.5c-.77.833.192 2.5 1.732 2.5z"/>
                </svg>
            </div>
            <h3 id="confirm-modal-title" class="text-lg font-bold text-text-primary">{{ __('Confirm action') }}</h3>
            <p id="confirm-modal-message" class="text-text-secondary text-sm mt-2">{{ __('Are you sure?') }}</p>
        </div>

        <div class="space-y-4">
            <div>
                <label class="block text-sm font-medium text-text-primary mb-2">
                    {{ __('Please type') }} <span class="font-bold text-gold-light">"{{ $confirmText }}"</span> {{ __('to confirm') }}
                </label>
                <input type="text" id="confirm-modal-input"
                       class="input w-full text-center text-lg font-bold tracking-widest"
                       placeholder="{{ $confirmText }}"
                       onkeydown="if (event.key === 'Enter') { event.preventDefault(); submitConfirmModal(); }"
                       oninput="document.getElementById('confirm-modal-error').classList.add('hidden')">
                <p id="confirm-modal-error" class="text-coral-light text-xs mt-2 hidden">
                    {{ __('Please type :text to confirm', ['text' => $confirmText]) }}
                </p>
            </div>

            <div class="flex gap-3">
                <button type="button" onclick="hideConfirmModal()"
                        class="flex-1 px-4 py-2.5 rounded-[10px] text-sm font-medium bg-surface hover:bg-surface-hover text-text-secondary transition-all duration-200">
                    {{ __('Cancel') }}
                </button>
                <button type="button" id="confirm-modal-confirm" onclick="submitConfirmModal()"
                        class="flex-1 px-4 py-2.5 rounded-[10px] text-sm font-bold text-white bg-coral hover:scale-105 hover:shadow-lg hover:shadow-black/25 active:scale-95 transition-all duration-200 ease-out">
                    <span id="confirm-modal-btn-text">{{ __('Confirm') }}</span>
                </button>
            </div>
        </div>
    </div>
</div>

<script>
var confirmModalState = { action: '', method: 'POST', confirmText: '{{ $confirmText }}' };

window.openConfirmModal = function(data) {
    confirmModalState.action = data.action || '';
    confirmModalState.method = data.method || 'POST';
    document.getElementById('confirm-modal-title').textContent = data.title || '{{ __('Confirm action') }}';
    document.getElementById('confirm-modal-message').textContent = data.message || '{{ __('Are you sure?') }}';
    document.getElementById('confirm-modal-btn-text').textContent = data.buttonText || '{{ __('Confirm') }}';
    var btn = document.getElementById('confirm-modal-confirm');
    btn.className = 'flex-1 px-4 py-2.5 rounded-[10px] text-sm font-bold text-white transition-all duration-200 ease-out hover:scale-105 hover:shadow-lg hover:shadow-black/25 active:scale-95 ' + (data.buttonClass || 'bg-coral');
    document.getElementById('confirm-modal-input').value = '';
    document.getElementById('confirm-modal-error').classList.add('hidden');
    document.getElementById('confirm-modal-overlay').classList.remove('hidden');
    return false;
};

function hideConfirmModal() {
    document.getElementById('confirm-modal-overlay').classList.add('hidden');
}

function submitConfirmModal() {
    var input = document.getElementById('confirm-modal-input').value;
    if (input !== confirmModalState.confirmText) {
        document.getElementById('confirm-modal-error').classList.remove('hidden');
        return;
    }
    var form = document.createElement('form');
    form.method = 'POST';
    form.action = confirmModalState.action;
    var csrf = document.createElement('input');
    csrf.type = 'hidden';
    csrf.name = '_token';
    var meta = document.querySelector('meta[name="csrf-token"]');
    csrf.value = meta ? meta.getAttribute('content') : '';
    form.appendChild(csrf);
    if (confirmModalState.method !== 'POST') {
        var methodInput = document.createElement('input');
        methodInput.type = 'hidden';
        methodInput.name = '_method';
        methodInput.value = confirmModalState.method;
        form.appendChild(methodInput);
    }
    document.body.appendChild(form);
    form.submit();
}
</script>
