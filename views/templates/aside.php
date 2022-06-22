<div class="card">
  <h5 class="card-header d-flex justify-content-between align-items-center">
    Chercher
  </h5>
  <form action="<?= BASE_URL ?>/search" class="px-4 search-form">
    <input autocomplete="off" type="text" name="query" class="form-control mb-3" placeholder="Rechercher des utilisateurs" />
    <button type="submit" class="btn btn-primary me-2">
      Rechercher
    </button>
  </form>
  <?php if (count($followers) > 0) : ?>
    <div class="px-4 mt-2">
      <hr>
    </div>
    <h5 class="card-header d-flex justify-content-between align-items-center">
      following
    </h5>
    <div class="px-4">
      <?php foreach ($followers as $follower) : ?>
        <div class="mb-3">
          <a href="<?= BASE_URL . '/user/' . $follower['id_following'] ?>">
            <?= ucfirst($follower['follower_firstname']) . ' ' . strtoupper($follower['follower_lastname']) ?>
          </a>
        </div>
      <?php endforeach; ?>
    </div>
  <?php endif; ?>
  <?php if (count($following) > 0) : ?>
    <div class="px-4 mt-2">
      <hr>
    </div>
    <h5 class="card-header d-flex justify-content-between align-items-center">
      followers
    </h5>
    <div class="px-4">
      <?php foreach ($following as $f) : ?>
        <div class="mb-3">
          <a href="<?= BASE_URL . '/user/' . $f['id_follower'] ?>">
            <?= ucfirst($f['following_firstname']) . ' ' . strtoupper($f['following_lastname']) ?>
          </a>
        </div>
      <?php endforeach; ?>
    </div>
  <?php endif; ?>
</div>