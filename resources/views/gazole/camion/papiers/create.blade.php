@extends('gazole.layouts.master')

@section('content')
    <form method="POST" action="{{ route('papiers.store') }}">
        @csrf
        <div class="row">
            <div class="col-6">
                <label for="exampleInputPassword1" class="form-label">title *</label>
                <input type="text" name="title" placeholder="papier title" class="form-control" id="exampleInputPassword1">
            </div>
            <div class="col-md-6">
                <label for="inputState" class="form-label">Camion</label>
                <select id="inputState" name="camion_id" class="form-select">
                    @foreach (\App\Models\Camion::active()->get() as $item)
                        <option value="{{ $item->id }}">{{ $item->matricule }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-6">
                <label for="inputAddress" class="form-label">date last used</label>
                <input type="date" value="{{ date('Y-m-d') }}" name="last_notification" class="form-control" id="last_notification">
            </div>
            <div class="col-6">
                <label for="inputAddress" class="form-label">Days count</label>
                <input type="number" min="1" name="days_count" id="days_count" class="form-control"
                    placeholder="insert the number as days not month : 3 month insert it like 90 (days) just number ">
            </div>
            <p id="calculatedDate" class="mt-2 text-success fw-bold text-center"></p> <!-- The calculated date will appear here -->
            <div class="col-12">
                <label for="inputAddress" class="form-label">description</label>
                <textarea class="form-control" id="body" placeholder="Enter the Description" name="description"></textarea>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection

@section('style')
    <script src="https://cdn.ckeditor.com/ckeditor5/23.0.0/classic/ckeditor.js"></script>
@endsection

@section('scripts')
    <script>
        ClassicEditor
            .create(document.querySelector('#body'))
            .catch(error => {
                console.error(error);
            });

        // Script to calculate and display the future date
        document.addEventListener('DOMContentLoaded', function() {
            const lastNotificationInput = document.getElementById('last_notification');
            const daysCountInput = document.getElementById('days_count');
            const resultElement = document.getElementById('calculatedDate');

            function calculateDate() {
                const dateValue = lastNotificationInput.value;
                const days = parseInt(daysCountInput.value);

                if (dateValue && !isNaN(days)) {
                    let selectedDate = new Date(dateValue);
                    selectedDate.setDate(selectedDate.getDate() + days);

                    const formattedDate = selectedDate.toLocaleDateString('en-GB'); // DD/MM/YYYY
                    resultElement.textContent = `Date after ${days} days: ${formattedDate}`;
                } else {
                    resultElement.textContent = '';
                }
            }

            lastNotificationInput.addEventListener('change', calculateDate);
            daysCountInput.addEventListener('input', calculateDate);
        });
    </script>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
@endsection
