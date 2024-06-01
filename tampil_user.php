
<h2>Daftar User</h2>
<a href="index.php">Kembali</a>
<a href="./input_user.php">Tambah Data User</a>
<table class="table">
    <thead>
        <tr>
            
            <th>No</th>
            <th>email</th>
            <th>password</th>
            <th>Role</th>
            <th>Status</th>
           
        </tr>
    </thead>
    <tbody>
        <?php
        include 'koneksi.php';

        $no = 1;
        $data = mysqli_query($koneksi, "SELECT * FROM user");

        while ($d = mysqli_fetch_array($data)) {
        ?>
            <tr>
                <td><?= $no++; ?></td>
           
                <td><?= $d['email']; ?></td>
                <td><?= $d['password']; ?></td>
                <td><?= $d['role']; ?></td>
                <td><?= $d['status']; ?></td>
               
                <td>
                    <a href="edit_user.php?id=<?= $d['id_user'] ?>">EDIT</a>
                    <a href="hapus_user.php?id=<?= $d['id_user'] ?>">HAPUS</a>
                </td>
            </tr>
        <?php
        }
        ?>
    </tbody>
</table>
