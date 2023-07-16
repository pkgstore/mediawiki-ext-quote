<?php

namespace MediaWiki\Extension\PkgStore;

use MWException;
use OutputPage, Parser, PPFrame, Skin;

/**
 * Class MW_EXT_Quote
 */
class MW_EXT_Quote
{
  /**
   * Register tag function.
   *
   * @param Parser $parser
   *
   * @return void
   * @throws MWException
   */
  public static function onParserFirstCallInit(Parser $parser): void
  {
    $parser->setHook('quote', [__CLASS__, 'onRenderTag']);
  }

  /**
   * Render tag function.
   *
   * @param $input
   * @param array $args
   * @param Parser $parser
   * @param PPFrame $frame
   *
   * @return string
   */
  public static function onRenderTag($input, array $args, Parser $parser, PPFrame $frame): string
  {
    // Argument: source.
    $getSource = MW_EXT_Kernel::outClear($args['source'] ?? '' ?: '');
    $outSource = $getSource;

    // Argument: person.
    $getSign = MW_EXT_Kernel::outClear($args['sign'] ?? '' ?: '');
    $outSign = empty($getSign) ? '' : '<span><i class="far fa-user fa-fw"></i> <a href="' . $outSource . '" target="_blank">' . $getSign . '</a></span>';

    // Argument: date.
    $getDate = MW_EXT_Kernel::outClear($args['date'] ?? '' ?: '');
    $outDate = empty($getDate) ? '' : '<span><i class="far fa-clock fa-fw"></i> ' . $getDate . '</span>';

    // Get content.
    $getContent = trim($input);
    $outContent = $parser->recursiveTagParse($getContent, $frame);

    // Check person and date arguments, and set footer.
    if ($outSign || $outDate) {
      $outFooter = '<footer><cite>' . $outSign . $outDate . '</cite></footer>';
    } else {
      $outFooter = '';
    }

    // Out parser.
    return '<blockquote class="mw-quote navigation-not-searchable" cite="' . $outSource . '"><div class="mw-quote-content">' . $outContent . '</div>' . $outFooter . '</blockquote>';
  }

  /**
   * Load resource function.
   *
   * @param OutputPage $out
   * @param Skin $skin
   *
   * @return void
   */
  public static function onBeforePageDisplay(OutputPage $out, Skin $skin): void
  {
    $out->addModuleStyles(['ext.mw.quote.styles']);
  }
}
