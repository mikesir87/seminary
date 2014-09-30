<?php

$index = 0;

function SM($reference, $phrase) {
  global $index;
  $sm = new stdClass();
  $sm->index = $index++;
  $sm->reference = $reference;
  $sm->phrase = $phrase;
  return $sm;
}

$verses = array(
  SM("JSH 1:15-20", "The First Vision"),
  SM("D&C 1:37-38", "Jesus Christ's words shall all be fulfilled"),
  SM("D&C 6:36", "Look unto Christ in every thought"),
  SM("D&C 8:2-3", "Revelation comes to your mind and heart"),
  SM("D&C 10:5", "Pray always"),
  SM("D&C 13:1", "The Aaronic Priesthood was restored"),
  SM("D&C 18:10-11", "The worth of souls is great"),
  SM("D&C 18:15-16", "Great joy comes from bringing souls unto Jesus Christ"),
  SM("D&C 19:16-19", "Jesus Christ suffered for all of us"),
  SM("D&C 19:23", "Learn of the Savior, and listen to His words"),
  SM("D&C 25:13", "Cleave to your covenants"),
  SM("D&C 46:33", "Practice virtue and holiness continually"),
  SM("D&C 58:27", "Be anxiously engaged in a good cause"),
  SM("D&C 58:42-43", "To repent we must confess and forsake sin"),
  SM("D&C 64:9-11", "We should forgive all men"),
  SM("D&C 76:22-24", "Jesus Christ lives"),
  SM("D&C 76:40-41", "Jesus Christ was crucified and bore our sins"),
  SM("D&C 78:19", "Receive all things with thankfulness"),
  SM("D&C 82:10", "The Lord is bound to bless the obedient"),
  SM("D&C 88:124", "Cease to be idle and unclean"),
  SM("D&C 89:18-21", "Blessings of the Word of Wisdom"),
  SM("D&C 107:8", "The Melchizedek Priesthood administers in spiritual things"),  SM("D&C 121:36, 41-42", "The principles of righteousness give power to the priesthood"),
  SM("D&C 130:22-23", "The Father and Son have bodies of flesh and bones"),
  SM("D&C 131:1-4", "The new and everlasting covenant of marriage")
);

echo json_encode($verses);
