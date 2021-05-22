@component('mail::message')
# Introduction

## Congratulation for being part of the UDK Programe.
Please use belows credential to access to the system.

<div>
    <h4 style="text-align:center"><u>PERINGATAN PEMBAYARAN LEVI KEUNTUNGAN LUAR BIASA</u></h4>
    <p>1. Adalah diingatkan kepada pelesen-pelesen supaya mengemukakan penyata bulanan dan membuat pembayaran cukai levi sawit pada tempoh masa yang telah ditetapkan iaitu 1 hingga 28 hari bulan hari bekerja bagi setiap bulan.</p>
    <p>2. Sekiranya pelesen gagal mengemukakan penyata dan membuat bayaran sebelum tarikh yang telah ditetapkan, tindakan penalti akan dikenakan.</p>
    <p>3. Oleh itu, berdasarkan harga yang telah dikeluarkan oleh Malaysia Palm Oil Board (MPOB), jumlah keseluruhan yang perlu dibayar adalah seperti berikut.</p>
</div>

@component('mail::button', ['url' => url('login'), 'target="_blank'])
Login
@endcomponent

Thanks,<br>
UDK Admin
@endcomponent
