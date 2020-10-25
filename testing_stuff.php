<?php

$meme = array
(
    "stufdhufj" => "Fdgfd",
    "sijtufldhufj" => "Fdgfd",
    "sijtufdhufj" => "Fdgfd",
    "stkufdhufj" => "Fdgfd",
    "question_1" => "emememem",
    "answer_1" => "hello_world",
    "question_2" => "dsvi",
    "answer_2" => "f40e",
    "question_3" => "kkllkl",
    "answer_3" => "dsfd",
);

$content = array( );
$m_iCurrent = -1;

foreach ( $meme as $m_Key => $m_Value )
{
    $m_aData = explode( "_", $m_Key );
    if ( count( $m_aData ) != 2 )
        continue;

    if ( $m_aData[ 0 ] == "question" )
    {
        $content[ ] = array( $m_Value, "" );
        $m_iCurrent++;
    }
    elseif ( $m_aData[ 0 ] == "answer" )
        $content[ $m_iCurrent ][ 1 ] = $m_Value;
}

print_r( $content );
echo json_encode( $content );