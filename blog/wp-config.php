<?php
/**
 * WordPress の基本設定
 *
 * このファイルは、インストール時に wp-config.php 作成ウィザードが利用します。
 * ウィザードを介さずにこのファイルを "wp-config.php" という名前でコピーして
 * 直接編集して値を入力してもかまいません。
 *
 * このファイルは、以下の設定を含みます。
 *
 * * MySQL 設定
 * * 秘密鍵
 * * データベーステーブル接頭辞
 * * ABSPATH
 *
 * @link http://wpdocs.sourceforge.jp/wp-config.php_%E3%81%AE%E7%B7%A8%E9%9B%86
 *
 * @package WordPress
 */

// 注意: 
// Windows の "メモ帳" でこのファイルを編集しないでください !
// 問題なく使えるテキストエディタ
// (http://wpdocs.sourceforge.jp/Codex:%E8%AB%87%E8%A9%B1%E5%AE%A4 参照)
// を使用し、必ず UTF-8 の BOM なし (UTF-8N) で保存してください。

// ** MySQL 設定 - この情報はホスティング先から入手してください。 ** //
/** WordPress のためのデータベース名 */
define('DB_NAME', 'LAA0436367-datsuden');

/** MySQL データベースのユーザー名 */
define('DB_USER', 'LAA0436367');

/** MySQL データベースのパスワード */
define('DB_PASSWORD', 'datsuden1234');

/** MySQL のホスト名 */
define('DB_HOST', 'mysql101.phy.lolipop.lan');

/** データベースのテーブルを作成する際のデータベースの文字セット */
define('DB_CHARSET', 'utf8');

/** データベースの照合順序 (ほとんどの場合変更する必要はありません) */
define('DB_COLLATE', '');

/**#@+
 * 認証用ユニークキー
 *
 * それぞれを異なるユニーク (一意) な文字列に変更してください。
 * {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org の秘密鍵サービス} で自動生成することもできます。
 * 後でいつでも変更して、既存のすべての cookie を無効にできます。これにより、すべてのユーザーを強制的に再ログインさせることになります。
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '=ui#Zn4/Ib`F+hG=6k>paL)ql3]t&CtlT-9S:udD)_dbSu]-R|,B9)d@y&&Y&+0v');
define('SECURE_AUTH_KEY',  '+NU1 Tpx6#y~P&MiP$k,aY4,of06Stn@ukU|tdU**K_R9D7lETSP8Ckd-Z59|>%i');
define('LOGGED_IN_KEY',    'f7k_#dX*6ZAVQRNDF Y%Go5sI||S%T5hBsh+hD5TvJ>HAvG?<t$Mk+$Te4Hx*nhG');
define('NONCE_KEY',        'f4lIYy]uN*&|9VMg2<2?+Rf&RBrX?+#AKC_mzG~q7?X?_j?Ukqz_aJ$`XBw0;39-');
define('AUTH_SALT',        'uu|!>==ztW?Et-RUqUiW !Zv}4^Rb|6%/GKNuP|.0^D_mdh9YHJ+0+hy?@5&EMUQ');
define('SECURE_AUTH_SALT', 'ww@%w|xay0O@ZK1frnM)~5V,SFw1a2;*N G#@^?;SNkajD5k`Br-4b)79Iq)WEpS');
define('LOGGED_IN_SALT',   'p~nUzaG4%{rHin]5Aq]p=!|%uAv|;6zAE9~a-&}{+5iJ2Ky1l_HN#G?pD<]9/Nhz');
define('NONCE_SALT',       '-e/(/(MDO>p[TR_DNLO{|s,!_xr]F/F6^>?|GyQCr(%9d;/|4kb7*G{56KkgHp>u');

/**#@-*/

/**
 * WordPress データベーステーブルの接頭辞
 *
 * それぞれにユニーク (一意) な接頭辞を与えることで一つのデータベースに複数の WordPress を
 * インストールすることができます。半角英数字と下線のみを使用してください。
 */
$table_prefix  = 'wp_';

/**
 * 開発者へ: WordPress デバッグモード
 *
 * この値を true にすると、開発中に注意 (notice) を表示します。
 * テーマおよびプラグインの開発者には、その開発環境においてこの WP_DEBUG を使用することを強く推奨します。
 *
 * その他のデバッグに利用できる定数については Codex をご覧ください。
 *
 * @link http://wpdocs.osdn.jp/WordPress%E3%81%A7%E3%81%AE%E3%83%87%E3%83%90%E3%83%83%E3%82%B0
 */
define('WP_DEBUG', false);

/* 編集が必要なのはここまでです ! WordPress でブログをお楽しみください。 */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
