@extends('layout_template')

@section('style')

  .report-section{
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
  }

  .profile-card {
    width: 100%;
    max-width: 600px;
    background: #fff;
    border-radius: 15px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    padding: 20px;
    margin: 20px;
  }
  .profile-header {
    display: flex;
    align-items: center;
    margin-bottom: 20px;
  }

  .avatar {
      width: 70px;
      aspect-ratio: 1;
      border-radius: 50%;
      background-color: #ccc; /* Временно серый фон */
      margin-right: 20px;
      overflow: hidden;
  }

  .avatar img {
      object-fit: cover;
      width: 100%;
      height: 100%;
  }

  
  .name-role {
    flex-grow: 1;
  }
  .name {
    font-size: 18px;
    font-weight: bold;
  }
  .role {
    font-size: 14px;
    color: #888;
  }
  .description {
    text-align: justify;
    overflow-wrap: break-word;
    white-space: normal;
    margin-bottom: 20px;
    font-size: 16px;
    color: #333;
    border: 1px solid #ddd;
    border-radius: 15px;
    padding: 10px;
  }
  .images {
    display: grid;
    grid-template-areas:
      "img1 img1 img2 img3"
      "img4 img5 img6 img6"
      "img7 img8 img9 img9";
    gap: 10px;
    border: 1px solid #ddd;
    border-radius: 15px;
    padding: 10px;
  }
  .images img {
    width: 100%;
    height: auto;
    border-radius: 15px;
  }
  .images img:nth-child(1) { grid-area: img1; }
  .images img:nth-child(2) { grid-area: img2; }
  .images img:nth-child(3) { grid-area: img3; }
  .images img:nth-child(4) { grid-area: img4; }
  .images img:nth-child(5) { grid-area: img5; }
  .images img:nth-child(6) { grid-area: img6; }
  .images img:nth-child(7) { grid-area: img7; }
  .images img:nth-child(8) { grid-area: img8; }
  .images img:nth-child(9) { grid-area: img9; }
@endsection

@section('content')
  <!-- верхушка с аватаром -->
  <div class="report-section">
    <div class="profile-card">
      <div class="button-back-row">
        <a onclick="history.back()" class="button-back-text">
          <div class="button-back-container">
            <img class="button-back-img" src="/storage/icons/back_icon.png">
            <span>Назад</span>
          </div>
        </a>
      </div>

      <div class="profile-header">
        <div class="avatar">
          <a href="{{ route('other.profile', ['id' => $user->User_ID]) }}">
            <img src="{{ $user->{'Фото профиля'} }}">
          </a>
        </div>
        <div class="name-role">
          <div class="name">{{$user->Фамилия}} {{$user->Имя}}</div>
          <div class="role">Организатор</div>
        </div>
      </div>
      
      <!-- поле с текстом -->
      <div class="description">
        {{$report->text}}
      </div>

      @if(!empty($images))
      <div class="images" id="image-grid">
        @foreach($images as $image)
          <img src="{{ $image }}" alt="Фото {{ $loop->iteration }}">
        @endforeach
      </div>
      @endif
  </div>
  
  <?php if ($user != null): ?>
    <script>
      if (<?php echo $user->Role_ID; ?> === 0) {
          var role = document.getElementById('volunteer_nav');
          if (role) {
              role.remove();
          }
      } else if (<?php echo $user->Role_ID; ?> === 1) {
          var role = document.getElementById('organizer_nav');
          if (role) {
              role.remove();
          }
      }
    </script>
  <?php endif; ?>

@endsection
