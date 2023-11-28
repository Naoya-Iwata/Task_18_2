'use strict';

$(function () {
  // ページトップへボタン
  const pagetop = $('.page-top');
  // window(node)がスクロールされた時に実行
  $(window).on('scroll', function () {
    // console.log($(this).scrollTop());
    // ページトップからのスクロール量が100pxを超えたらボタンを表示（非表示）
    if ($(this).scrollTop() > 400) {
      pagetop.fadeIn();
    } else {
      pagetop.fadeOut();
    }
  });
  // ページトップへ500msかけてスムーススクロール
  // スクロール可能な要素を取得（IE除く）
  const scrlElement = document.scrollingElement;
  pagetop.on('click', function () {
    $(scrlElement).animate({ scrollTop: 0 }, 500, 'swing');
  });
});

$(function () {
  // ハンバーガーボタンクリックでボタンのアニメーションとナビ開閉
  $('.hbg-btn').on('click', function () {
    $(this).toggleClass('open');
    $('.gnav').toggleClass('slide');
    let btntext = document.getElementById('hbg-text');
    $(this).hasClass('open') ? $((btntext.textContent = 'CLOSE')) : $((btntext.textContent = 'MENU'));
  });

  // #で始まるリンクをクリックしたらスムースにスクロール + ナビゲーションを閉じてボタンを元に戻す
  // href属性が#で始まる<a>要素をクリックしたとき
  $('a[href^="#"]').on('click', function (event) {
    // href属性の値を取得
    const href = $(event.currentTarget).attr('href');
    // 文字列'html'または変数hrefの値('#...')を取得してjQueryオブジェクトに変換
    const target = $(href === '#' ? 'html' : href);
    // ページトップから要素targetまでの縦方向の距離を取得（横方向はoffset().left）
    const position = target.offset().top;
    // ハンバーガーボタンとナビゲーションをリセット
    $('.hbg-btn').removeClass('open');
    $('.gnav').removeClass('slide');
    // htmlまたはbody要素をpositionまでスクロール
    // WebKit(Safari)はbody、その他(Blinkなど)はhtmlで有効
    $('html, body').animate({ scrollTop: position }, 600, 'swing');

    // スクロール可能な要素を取得する場合（IE除く）
    // const scrlElement = document.scrollingElement;
    // $(scrlElement).animate({ scrollTop: position }, 600, 'swing');
  });
});

// 画面の幅（スクロールバーを含む）を取得
const windowWidth = window.innerWidth;
// スマホでは、ヘッダーを下スクロールで消し、上スクロールで出す
if (windowWidth < 901) {
  let startPos = 0; // 直前のスクロール位置
  let currentPos = 0; // 現在のスクロール位置
  // windowがスクロールされたときに実行
  $(window).on('scroll', function () {
    // ページトップからのスクロール位置を取得
    currentPos = $(this).scrollTop();
    // ナビが開いているときは何もしない
    if ($('.gnav').hasClass('slide')) {
      // 何もしない
    } else {
      if (currentPos > startPos && currentPos > 100) {
        $('.header').addClass('slide-hide');
      } else {
        $('.header').removeClass('slide-hide');
      }
      // 現在のスクロール位置をstartPosにセット
      startPos = currentPos;
    }
  });
}

// ランキングページのギミック

$(function () {
  // selectがチェンジした場合に処理
  $('select').change(function () {
    // スクロールの速度
    var speed = 400; // ミリ秒
    // 期間の値取得
    var value = $(this).val(); // 対象期間の（value）を取得して、valueという変数に代入

    if (value === 'weekly-ranking') {
      $('#weekly-ranking').removeClass('hidden');
      $('#daily-ranking').addClass('hidden');
      $('#monsly-ranking').addClass('hidden');
    } else if (value === 'monsly-ranking') {
      $('#weekly-ranking').addClass('hidden');
      $('#daily-ranking').addClass('hidden');
      $('#monsly-ranking').removeClass('hidden');
    } else if (value === 'daily-ranking') {
      $('#weekly-ranking').addClass('hidden');
      $('#daily-ranking').removeClass('hidden');
      $('#monsly-ranking').addClass('hidden');
    } else {
    }

    return false;
  });

  // ここからmusic.html

  $('.serch-view-btn').on('click', function () {
    $('.serch-wrapper').toggleClass('pos-down');
    $('.serch-view-btn').toggleClass('serch-view-btn-on');
  });

  // チェックボックスに上限3個
  const checkMax = 3;
  const checkBoxes = document.getElementsByName('genre');

  function checkCount(target) {
    let checkCount = 0;
    checkBoxes.forEach((checkBox) => {
      if (checkBox.checked) {
        checkCount++;
      }
    });
    if (checkCount > checkMax) {
      // alert('3つまで選択してください。');
      document.getElementById('genre-alert').innerHTML = `<p style="color:red;">※3つまでで選択してください。</p>`;
      target.checked = false;
    }
  }

  checkBoxes.forEach((checkBox) => {
    checkBox.addEventListener('change', () => {
      checkCount(checkBox);
    });
  });

  // ここからdonationページのギミック

  let addcount = 0;
  $('#addkey-btn').on('click', function () {
    event.preventDefault();

    if (addcount < 4) {
      let add = '<input type="text" name="key-word" class="addkey-box">';
      document.getElementById('add-pos').insertAdjacentHTML('beforeend', add);
      addcount += 1;
    } else {
      document.getElementById('addalert').innerHTML = `<p style="color:red;">※5つまでしか追加できません。</p>`;
    }
  });

  // ここからcontact.html
  $('#touroku-form').on('click', function () {
    $('.touroku-wrapper').toggleClass('hide');
  });
  $('#toiawase-form').on('click', function () {
    $('.toiawase-wrapper').toggleClass('hide');
  });
});

// ここからプレイヤーボタン

// 再生時間表示用関数
// audioから取得できる時間データは秒ですので、mm:ss形式に直す関数を用意します。

function playTime(t) {
  let hms = '';
  const h = (t / 3600) | 0;
  const m = ((t % 3600) / 60) | 0;
  const s = t % 60;
  const z2 = (v) => {
    const s = '00' + v;
    return s.substr(s.length - 2, 2);
  };
  if (h != 0) {
    hms = h + ':' + z2(m) + ':' + z2(s);
  } else if (m != 0) {
    hms = z2(m) + ':' + z2(s);
  } else {
    hms = '00:' + z2(s);
  }
  return hms;
}

// 現在時刻と再生時間はaudio.currentTimeとaudio.durationで取得できますが、そのタイミングのデータしか得られません。audio再生中はtimeupdateイベントが起こるのでそれを拾ってそれぞれ取得・更新します。
// durationはたまにnullになったりするので数字かどうかを確認します。
// 1秒間に4回くらいtimeupdateが走ります。

// const audio = document.getElementsByTagName('audio')[0];
// audio.addEventListener('timeupdate', (e) => {
//   const current = Math.floor(audio.currentTime);
//   const duration = Math.round(audio.duration);
//   if (!isNaN(duration)) {
//     document.getElementById('current').innerHTML = playTime(current);
//     document.getElementById('duration').innerHTML = playTime(duration);
//   }
//   const percent = Math.round((audio.currentTime / audio.duration) * 1000) / 10;
//   document.getElementById('seekbar').style.backgroundSize = percent + '%';
// });

// 前回作ったコントローラは再生と停止(一時停止)ボタンを別にしていましたが、それらを1つのボタンにまとめ、停止ボタンは停止と曲頭に戻るようにします。
// 再生ボタンが押されたときに、audioが再生しているかをみて再生中であれば一時停止、一時停止中であれば再生します。ついでに再生ボタンの文字も変えます。
// また、停止ボタンを押すと曲の頭に戻ります。

// const playButton = document.getElementById('play');
// const stopButton = document.getElementById('stop');

// playButton.addEventListener('click', () => {
//   if (audio.paused) {
//     audio.play();
//     play.innerHTML = play.innerHTML === '<i class="fa-solid fa-play"></i>' ? '<i class="fa-solid fa-pause"></i>' : '<i class="fa-solid fa-play"></i>';
//   } else {
//     audio.pause();
//     play.innerHTML = '<i class="fa-solid fa-play"></i>';
//   }
// });

// ※今回は停止ボタンはなしにします。
// stopButton.addEventListener('click', () => {
//   audio.pause();
//   audio.currentTime = 0;
// });

// シークバー
// シークバーをクリックした位置を取得してそこから再生時間を計算します。
// 要素がクリックされたときにクリックされた座標と要素のサイズから割合を出します。
// currentTime属性に代入することでシークすることができます。

// document.getElementById('seekbar').addEventListener('click', (e) => {
//   const duration = Math.round(audio.duration);
//   if (!isNaN(duration)) {
//     const mouse = e.pageX;
//     const element = document.getElementById('seekbar');
//     const rect = element.getBoundingClientRect();
//     const position = rect.left + window.pageXOffset;
//     const offset = mouse - position;
//     const width = rect.right - rect.left;
//     audio.currentTime = Math.round(duration * (offset / width));
//   }
// });

// ボリュームシークをリアルタイム音量に連動
/* window.addEventListener('DOMContentLoaded', function () {
  const btn_mute = document.getElementById('btn_mute');
  const slider_volume = document.getElementById('volume');
  const audioElement = document.querySelector('audio');

  // ボリュームの初期設定
  audioElement.volume = slider_volume.value;
  btn_mute.addEventListener('click', (e) => {
    if (audioElement.muted) {
      audioElement.muted = false;
      btn_mute.innerHTML = '<i class="fa-solid fa-volume-high" ></i></span>';
    } else {
      audioElement.muted = true;
      btn_mute.innerHTML = '<i class="fa-solid fa-volume-xmark"></i>';
    }
  });

  slider_volume.addEventListener('input', (e) => {
    audioElement.volume = slider_volume.value;
  });

  // 早送り、巻き戻しの設定
  const btn_back = document.getElementById('btn_back');
  const btn_forward = document.getElementById('btn_forward');

  btn_back.addEventListener('click', (e) => {
    audioElement.currentTime -= 10;
  });

  btn_forward.addEventListener('click', (e) => {
    audioElement.currentTime += 10;
  });

  let intervalID = 0;
  btn_back.onmousedown = function () {
    intervalID = setInterval(function () {
      audioElement.currentTime = 0;
    }, 1500);
    btn_back.onmouseup = function () {
      clearInterval(intervalID);
    };
  };

  btn_forward.onmousedown = function () {
    intervalID = setInterval(function () {
      audioElement.currentTime = audio.duration + 1;
    }, 1500);
    btn_forward.onmouseup = function () {
      clearInterval(intervalID);
    };
  };

  btn_back.ontouchstart = function () {
    intervalID = setInterval(function () {
      audioElement.currentTime = 0;
    }, 1500);
    btn_back.ontouchend = function () {
      clearInterval(intervalID);
    };
  };

  btn_forward.ontouchstart = function () {
    intervalID = setInterval(function () {
      audioElement.currentTime = audio.duration + 1;
    }, 1500);
    btn_forward.ontouchend = function () {
      clearInterval(intervalID);
    };
  };
});
 */
// 再生終了と同時にplayボタンを初期デザインに
/* audio.addEventListener('ended', function () {
  document.getElementById('play').innerHTML = '<i class="fa-solid fa-play"></i>';
});

$(function () {
  $('.fav-btn i').on('click', function () {
    $(this).hasClass('fa-regular') ? $(this).attr('class', 'fa-solid fa-heart') : $(this).attr('class', 'fa-regular fa-heart');
  });
});
 */
// vue.jsを使ってボリュームシークのカスタマイズ
/* let app = new Vue({
  el: '#app',
  data: {
    red: 0.5,
  },
  computed: {
    redBar: function () {
      let percent = this.red * 100;
      return `linear-gradient(to right,rgba(158, 0, 236, 1) 0%, rgba(255,102, 130, 1) ${percent}%,#fff ${percent}%)`;
    },
  },
});
 */
