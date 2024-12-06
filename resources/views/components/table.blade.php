<div {{ $attributes->merge(['class' => 'd-flex justify-center']) }}>
    <table class="table table-striped mt-3  text-center">
        <thead>
            <tr>
                {{ $tableHead }}
            </tr>
        </thead>
        <tbody>
            <tr>
                {{ $tableBody }}

            </tr>
        </tbody>
    </table>
</div>
