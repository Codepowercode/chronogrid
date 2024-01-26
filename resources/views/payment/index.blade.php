<div>
    <form action="{{ route('payments.store') }}" method="POST">
        @csrf
        <button type="submit">Pay</button>
    </form>
</div>
