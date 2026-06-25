<form method="post" action="<?= base_url('machine-loading/store') ?>">

    <select name="machine_id" required>

        <?php foreach ($machines as $machine): ?>

            <option value="<?= $machine['id'] ?>">

                <?= $machine['machine_name'] ?>

            </option>

        <?php endforeach; ?>

    </select>

    <input
        type="number"
        name="qty"
        placeholder="Quantity"
        required>

    <button type="submit">
        Start Job
    </button>

</form>