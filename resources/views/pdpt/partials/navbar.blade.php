{{-- ══════════════════════════════════════════════
     SHARED NAVBAR — PDPT UGK
     Usage: @include('pdpt.partials.navbar', ['activePage' => 'home'])
     
     activePage values:
       home, data-dosen, data-tendik, 
       akreditasi-institusi, akreditasi-prodi
     ══════════════════════════════════════════════ --}}

@php
  $activePage = $activePage ?? '';
  $isDataActive = in_array($activePage, ['data-dosen', 'data-tendik', 'akreditasi-institusi', 'akreditasi-prodi']);
  $isRekapActive = in_array($activePage, ['rekap-dosen', 'rekap-tendik']);
@endphp

<nav class="navbar" id="navbar">
  <a href="/" class="nav-brand" id="navBrand">
    <img src="{{ asset('images/logo-ugk-dummy.svg') }}" alt="Logo UGK" class="nav-brand-logo">
    PDPT <span>UGK</span>
  </a>

  <button class="nav-toggle" id="navToggle" aria-label="Toggle menu">
    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
      <line x1="3" y1="6" x2="21" y2="6"/><line x1="3" y1="12" x2="21" y2="12"/><line x1="3" y1="18" x2="21" y2="18"/>
    </svg>
  </button>

  <div class="nav-items" id="navItems">
    {{-- Home --}}
    <a href="/pdpt/home" class="nav-item {{ $activePage === 'home' ? 'active' : '' }}" id="navHome">
      <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <path d="m3 9 9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/>
        <polyline points="9 22 9 12 15 12 15 22"/>
      </svg>
    </a>

    {{-- Data dropdown (Akreditasi + SDM) --}}
    <div class="nav-item {{ $isDataActive ? 'active' : '' }}" id="navData">
      Data
      <svg class="nav-caret" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"/></svg>
      <div class="nav-dropdown">
        <div class="nav-dropdown-header">Akreditasi</div>
        <a href="/pdpt/akreditasi-institusi" class="nav-dropdown-item {{ $activePage === 'akreditasi-institusi' ? 'dd-active' : '' }}">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="4" y="2" width="16" height="20" rx="2"/><path d="M9 22v-4h6v4"/></svg>
          Akreditasi Institusi
        </a>
        <a href="/pdpt/akreditasi-prodi" class="nav-dropdown-item {{ $activePage === 'akreditasi-prodi' ? 'dd-active' : '' }}">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 10v6M2 10l10-5 10 5-10 5z"/><path d="M6 12v5c3 3 10 3 12 0v-5"/></svg>
          Akreditasi Prodi
        </a>
        <div class="nav-dropdown-divider"></div>
        <div class="nav-dropdown-header">SDM</div>
        <a href="/pdpt/data-dosen" class="nav-dropdown-item {{ $activePage === 'data-dosen' ? 'dd-active' : '' }}">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
          Dosen
        </a>
        <a href="/pdpt/data-tendik" class="nav-dropdown-item {{ $activePage === 'data-tendik' ? 'dd-active' : '' }}">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
          Tenaga Kependidikan
        </a>
      </div>
    </div>

    {{-- Rekapitulasi dropdown --}}
    <div class="nav-item {{ $isRekapActive ? 'active' : '' }}" id="navRekap">
      Rekapitulasi
      <svg class="nav-caret" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"/></svg>
      <div class="nav-dropdown">
        <div class="nav-dropdown-header">Rekapitulasi</div>
        <a href="/pdpt/rekap-dosen" class="nav-dropdown-item {{ $activePage === 'rekap-dosen' ? 'dd-active' : '' }}">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
          Dosen
        </a>
        <a href="/pdpt/rekap-tendik" class="nav-dropdown-item {{ $activePage === 'rekap-tendik' ? 'dd-active' : '' }}">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
          Tenaga Kependidikan
        </a>
      </div>
    </div>

    {{-- Static links --}}
    <a href="/pdpt/buku-info-akademik" class="nav-item {{ $activePage === 'buku-info' ? 'active' : '' }}">
      <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 19.5v-15A2.5 2.5 0 0 1 6.5 2H20v20H6.5a2.5 2.5 0 0 1 0-5H20"/></svg>
      Panduan
    </a>
    <a href="/pdpt/tentang" class="nav-item {{ $activePage === 'tentang' ? 'active' : '' }}">
      <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="16" x2="12" y2="12"/><line x1="12" y1="8" x2="12.01" y2="8"/></svg>
      Tentang
    </a>
  </div>

  <div class="nav-right">
    <a href="/konversi-nilai/login" class="nav-login-btn">
      <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4"/><polyline points="10 17 15 12 10 7"/><line x1="15" y1="12" x2="3" y2="12"/></svg>
      Login
    </a>
  </div>
</nav>
