<?php require("../config/db-connect.php"); ?>
<?php require("../include/admin_header.php"); ?>

<div class="container mb-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <h1 class="text-center">Enter a new doctor record</h1>
            <form action="add_doctor.php" method="post">
                <div class="mb-3">
                    <label for="exampleInputName" class="form-label">Name</label>
                    <input type="text" name="name" class="form-control" id="exampleInputName" required>
                </div>
                
                <div class="mb-3">
                    <label for="exampleInputUsername" class="form-label">Username</label>
                    <input type="text" name="username" class="form-control" id="exampleInputUsername" required>
                </div>
                
                <div class="mb-3">
                    <label for="exampleInputPassword" class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" id="exampleInputPassword" required>
                </div>
                
                <div class="mb-3">
                    <label for="exampleInputContact" class="form-label">Contact</label>
                    <input type="text" name="contact" class="form-control" id="exampleInputContact" required>
                </div>
                
                <div class="mb-3">
                    <label for="exampleInputEmail" class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" id="exampleInputEmail" required>
                </div>
                
                <div class="mb-3">
                    <label for="exampleInputFees" class="form-label">Fees</label>
                    <input type="text" name="fees" class="form-control" id="exampleInputFees" required>
                </div>
                
                <div class="mb-3">
                    <label class="form-label">Please select the doctor's specialization category:</label>
                    <?php
                    $result = $conn->query("SELECT spec_id, category FROM specialization");
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            ?>
                            <div class="form-check">
                                <input type="radio" id="spec<?= $row['spec_id']; ?>" name="spec_id" value="<?= $row['spec_id']; ?>" class="form-check-input" required>
                                <label for="spec<?= $row['spec_id']; ?>" class="form-check-label"><?= htmlspecialchars($row['category']); ?></label>
                            </div>
                            <?php
                        }
                    } else {
                        echo "<p>No specializations found.</p>";
                    }
                    ?>
                </div>
                
                <div class="mb-3">
                    <input type="submit" class="btn btn-primary w-100" style="background-color: #2C5F8A;" name="submit" value="Submit"/>
                </div>
            </form>
        </div>
    </div>
</div>

<?php require("../include/footer.php"); ?>
</html>
