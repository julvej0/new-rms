<?php 
    include '../../../includes/admin/templates/header.php';
?>
<link rel="stylesheet" href="../../../css/index.css">
<link rel="stylesheet" href="new-publication.css">

<body>
<?php
    include '../../../includes/admin/templates/navbar.php';
?>
    <main>
        <div class="header">
            <h1 class="title">New Publication</h1>
        </div>
        <section>
            <div class="form-container">
                <form>
                    <div class="sub-container">
                        <div class="title">
                            <h3>Document Details</h3>
                            <hr>
                        </div>
                        <div class="form-container">
                            <div class="form-control">
                                <label class="pb-label" for="pb-title">Work title</label>
                                <input type="text" placeholder="Title" id="pb-title" />
                            </div>
                            <div class="form-control">
                                <label class="pb-label" for="pb-type">Type of Document</label>
                                <select class="select-type" name="pb-type" class="pb-input-field" id="pb-type" required>
                                    <option value="" hidden>--Choose from the options--</option>
                                    <option value="Original Article">Original Article</option>
                                    <option value="Review">Review</option>
                                    <option value="Proceedings">Proceedings</option>
                                    <option value="Communication">Communication</option>
                                    <option value="International">International</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </section>
    </main>
</section>
</body>