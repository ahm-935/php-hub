<?php
require_once 'models/parcel.class.php';
require_once 'models/rider.class.php'; 

$riders = Rider::readAll();
$show_receipt = false; 

if (isset($_POST['btn_submit'])) {
    $tracking_id     = $_POST['tracking_id'];
    $sender_name     = $_POST['sender_name'];
    $receiver_name   = $_POST['receiver_name'];
    $destination     = $_POST['destination'];
    $parcel_type     = $_POST['parcel_type']; 
    $weight          = $_POST['weight'];  
    $delivery_charge = $_POST['delivery_charge'];  
    $date            = $_POST['date']; 

    $parcel = new Parcel(null, $tracking_id, $sender_name, $receiver_name, $destination, $parcel_type, $weight, $delivery_charge, $date);
    $res = $parcel->create();
    
    if ($res === true) {
        $msg = "Parcel item added successfully.";
        $show_receipt = true; 
    } else {
        $msg = "Error: " . $res;
    }
}
?>
 
<div class="main-panel">
  <div class="content-wrapper">
    <div class="page-header">
      <h3 class="page-title"> Add New Parcel Item </h3>
    </div>
    <div class="row">
      <div class="col-12 grid-margin stretch-card">
        <?php if(isset($msg)): ?>
            <div class="alert alert-dark alert-dismissible fade show" role="alert">
                <?= htmlspecialchars($msg) ?>
                <button type="button" class="btn-close" data-dismiss="alert" aria-label="Close">&times;</button>
            </div>
        <?php endif; ?>
        
        <div class="card">
          <div class="card-body">
            <p class="card-description"> <a href="parcels"><button class="btn btn-dark">&larr; Back to List</button></a> </p>
            
            <form class="forms-sample" method="POST">
              <div class="form-group">
                <label>Tracking ID</label>
                <input type="text" class="form-control" name="tracking_id" value="TRK-<?= rand(100000, 999999) ?>" required readonly>
              </div>
              
              <div class="form-group">
                <label>Sender Name</label>
                <input type="text" class="form-control" name="sender_name" placeholder="Enter Sender Name" required>
              </div>
              
              <div class="form-group">
                <label>Receiver Name</label>
                <input type="text" class="form-control" name="receiver_name" placeholder="Enter Receiver Name" required>
              </div>
              
              <div class="form-group">
                <label>Destination</label>
                <input type="text" class="form-control" name="destination" placeholder="Enter Destination Address" required>
              </div>

              <div class="form-group">
                <label>Parcel Type</label>
                <select class="form-control" name="parcel_type" required>
                  <option value="">-- Select Type --</option>
                  <option value="Documents">Documents</option>
                  <option value="Electronics">Electronics</option>
                  <option value="Clothing">Clothing</option>
                  <option value="Liquid">Liquid</option>
                  <option value="Others">Others</option>
                </select>
              </div>

              <div class="form-group">
                <label>Weight (kg / gm)</label>
                <input type="text" class="form-control" name="weight" placeholder="e.g. 1.5 kg or 500 gm" required>
              </div>

              <div class="form-group">
                <label>Delivery Charge</label>
                <input type="text" class="form-control" name="delivery_charge" placeholder="Enter Delivery Charge">
              </div>

              <div class="form-group">
                <label>Date</label>
                <input type="date" class="form-control" name="date" value="<?= date('Y-m-d') ?>" required>
              </div>

              <button type="submit" name="btn_submit" class="btn btn-success mr-2">Submit</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php include('views/layouts/footer.php'); ?>
</div>

<script>
<?php if ($show_receipt === true): ?>
    window.addEventListener('DOMContentLoaded', (event) => {
        printCashMemo();
    });
<?php endif; ?>

document.addEventListener("DOMContentLoaded", function() {
    // ইনপুট এলিমেন্টগুলো সিলেক্ট করা
    const parcelTypeSelect = document.querySelector('select[name="parcel_type"]');
    const weightInput = document.querySelector('input[name="weight"]');
    const deliveryChargeInput = document.querySelector('input[name="delivery_charge"]');

    if (parcelTypeSelect && weightInput && deliveryChargeInput) {
        // কোনো একটি ফিল্ড পরিবর্তন হলেই চার্জ ক্যালকুলেট হবে
        parcelTypeSelect.addEventListener('change', calculateCharge);
        weightInput.addEventListener('input', calculateCharge);
    }

    function calculateCharge() {
        const type = parcelTypeSelect.value;
        const weightText = weightInput.value.trim().toLowerCase();

        if (!type || !weightText) {
            deliveryChargeInput.value = '';
            return;
        }

        // টেক্সট থেকে শুধু সংখ্যা (floating point) আলাদা করা
        const numericWeight = parseFloat(weightText.replace(/[^0-9.]/g, ''));
        if (isNaN(numericWeight) || numericWeight <= 0) {
            deliveryChargeInput.value = '';
            return;
        }

        // ওজন কেজি (KG) তে রূপান্তর করা (যদি gm বা gram লেখা থাকে)
        let weightInKg = numericWeight;
        if (weightText.includes('gm') || weightText.includes('gram')) {
            weightInKg = numericWeight / 1000; // গ্রাম থেকে কেজি
        }

        let baseCharge = 0;
        let perKgCharge = 0;

        // --- আপনার বিজনেস লজিক অনুযায়ী রেট চার্ট (এখানে পরিবর্তন করতে পারবেন) ---
        switch (type) {
            case 'Documents':
                baseCharge = 50;       // ১ কেজি পর্যন্ত ফিক্সড ৫০ টাকা
                perKgCharge = 15;      // অতিরিক্ত প্রতি কেজির জন্য ১৫ টাকা
                break;
            case 'Electronics':
                baseCharge = 100;      
                perKgCharge = 30;      
                break;
            case 'Clothing':
                baseCharge = 60;       
                perKgCharge = 20;      
                break;
            case 'Liquid':
                baseCharge = 120;      
                perKgCharge = 40;      
                break;
            default: // Others
                baseCharge = 70;       
                perKgCharge = 25;      
                break;
        }

        // মোট ডেলিভারি চার্জ হিসাব করা
        let totalCharge = baseCharge;
        if (weightInKg > 1) {
            // ১ কেজির বেশি হলে অতিরিক্ত ওজনের জন্য এক্সট্রা চার্জ যোগ হবে
            totalCharge += Math.ceil(weightInKg - 1) * perKgCharge;
        }

        deliveryChargeInput.value = totalCharge;
    }
});


function printCashMemo() {
    // json_encode ব্যবহারের ফলে কোটেশন সংক্রান্ত কোনো এরর হবে না
    let trackingId     = <?= isset($tracking_id) ? json_encode($tracking_id) : '""' ?>;
    let senderName     = <?= isset($sender_name) ? json_encode($sender_name) : '""' ?>;
    let receiverName   = <?= isset($receiver_name) ? json_encode($receiver_name) : '""' ?>;
    let destination    = <?= isset($destination) ? json_encode($destination) : '""' ?>;
    let parcelType     = <?= isset($parcel_type) ? json_encode($parcel_type) : '""' ?>;
    let weight         = <?= isset($weight) ? json_encode($weight) : '""' ?>;
    let deliveryCharge = "<?= isset($delivery_charge) ? number_format((float)$delivery_charge, 2) : '0.00' ?>";
    let date           = <?= isset($date) ? json_encode($date) : '""' ?>;

    let printWindow = window.open('', '_blank', 'width=450,height=650');
    if(!printWindow) {
        alert('Please allow pop-ups for this website to print receipts automatically!');
        return;
    }

    let receiptContent = `
        <html>
        <head>
            <title>Cash Memo - ${trackingId}</title>
            <style>
                body { font-family: 'Courier New', Courier, monospace; width: 320px; margin: 0 auto; padding: 10px; font-size: 14px; color: #000; line-height: 1.4; }
                .text-center { text-align: center; }
                .bold { font-weight: bold; }
                .brand-title { font-size: 22px; margin: 5px 0; font-weight: bold; text-transform: uppercase; }
                .divider { border-top: 1px dashed #000; margin: 10px 0; }
                .info-table { width: 100%; border-collapse: collapse; }
                .info-table td { padding: 4px 0; vertical-align: top; }
                .info-table td:first-child { width: 45%; }
                .total-row { font-size: 16px; font-weight: bold; }
                .footer-text { font-size: 11px; margin-top: 25px; }
                @media print { body { width: 100%; } }
            </style>
        </head>
        <body>
            <div class="text-center">
                <div class="brand-title">Connect Plus</div>
                <div>Courier & Logistics Service</div>
                <div class="divider"></div>
                <div class="bold" style="letter-spacing: 1px;">CASH MEMO / INVOICE</div>
            </div>
            <div class="divider"></div>
            <table class="info-table">
                <tr><td>Date:</td><td class="bold">${date}</td></tr>
                <tr><td>Tracking ID:</td><td class="bold" style="font-size: 15px;">${trackingId}</td></tr>
            </table>
            <div class="divider"></div>
            <table class="info-table">
                <tr><td>Sender:</td><td>${senderName}</td></tr>
                <tr><td>Receiver:</td><td>${receiverName}</td></tr>
                <tr><td>Destination:</td><td>${destination}</td></tr>
                <tr><td>Parcel Type:</td><td>${parcelType}</td></tr>
                <tr><td>Weight:</td><td>${weight}</td></tr>
            </table>
            <div class="divider"></div>
            <table class="info-table total-row">
                <tr><td>Total Charge:</td><td>৳ ${deliveryCharge}</td></tr>
            </table>
            <div class="divider"></div>
            <div class="text-center footer-text">
                <p>Thank you for choosing Connect Plus!</p>
                <p>Please keep this memo safe for tracking.</p>
            </div>
        </body>
        </html>
    `;

    printWindow.document.write(receiptContent);
    printWindow.document.close();
    
    setTimeout(function() {
        printWindow.focus();
        printWindow.print();
        printWindow.close();
    }, 400);
}
</script>