<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Profil Admin</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"/>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"/>

  <style>
    .profile-card {
      max-width: 500px;
      margin: 100px auto;
      padding: 30px;
      border-radius: 12px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    }

    .profile-img {
      width: 100px;
      height: 100px;
      object-fit: cover;
      border-radius: 50%;
      margin-bottom: 15px;
    }

    .edit-btn {
      float: right;
    }

    /* close */
    .close-btn {
  position: absolute;
  top: 15px;
  right: 20px;
  border: none;
  background: transparent;
  font-size: 18px;
  color: #999;
}

.close-btn:hover {
  color: #333;
}

  </style>
</head>
<body>
    <div class="modal fade" id="profilModal" tabindex="-1" aria-labelledby="profilModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Profil</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
            </div>
            <div class="modal-body text-center">
              @if(Auth::user()->foto)
    <img src="{{ asset('storage/' . Auth::user()->foto) }}" alt="Admin" class="rounded-circle me-2" width="40" height="40" style="object-fit: cover;">
@else
    <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center me-2" style="width: 40px; height: 40px; font-size: 18px;">
        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
    </div>
@endif

<span class="fw-bold">{{ Auth::user()->name }}</span>

              
              <h5>{{ Auth::user()->name }}</h5>
              <p class="text-muted">{{ ucfirst(Auth::user()->role) }}</p>
              <hr>
              <div class="text-start px-3">
                <p><strong>Email:</strong> {{ Auth::user()->email }}</p>
                <p><strong>No HP:</strong> {{ Auth::user()->nohp }}</p>
                <p><strong>Alamat:</strong> {{ Auth::user()->address }}</p>
              </div>
            </div>
            <div class="modal-footer">
              <a href="/pengaturan" class="btn btn-primary"><i class="fas fa-edit me-1"></i>Edit Profil</a>
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
          </div>
        </div>
      </div>



  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
