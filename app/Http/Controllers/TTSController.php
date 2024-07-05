<?php

namespace App\Http\Controllers;

use Google\Cloud\TextToSpeech\V1\AudioConfig;
use Google\Cloud\TextToSpeech\V1\AudioEncoding;
use Google\Cloud\TextToSpeech\V1\Client\TextToSpeechClient;
use Google\Cloud\TextToSpeech\V1\SsmlVoiceGender;
use Google\Cloud\TextToSpeech\V1\SynthesisInput;
use Google\Cloud\TextToSpeech\V1\SynthesizeSpeechRequest;
use Google\Cloud\TextToSpeech\V1\VoiceSelectionParams;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class TTSController extends Controller
{
    public function synthesize(Request $textRequest)
    {
        try {


            // create client object
            $client = new TextToSpeechClient([
                'credentials' => env('GOOGLE_APPLICATION_CREDENTIALS')
            ]);

            $inputText = (new SynthesisInput())
                ->setText($textRequest->input('text'));

            // note: the voice can also be specified by name
            // names of voices can be retrieved with $client->listVoices()
            $voice = (new VoiceSelectionParams())
                ->setLanguageCode('en-US')
                ->setSsmlGender(SsmlVoiceGender::MALE);

            // define effects profile id.
            $audioConfig = (new AudioConfig())
                ->setAudioEncoding(AudioEncoding::MP3);
            $request = (new SynthesizeSpeechRequest())
                ->setInput($inputText)
                ->setVoice($voice)
                ->setAudioConfig($audioConfig);

            $response = $client->synthesizeSpeech($request);
            $audioContent = $response->getAudioContent();

            $fileName = 'output-' . time() . '.mp3';
            file_put_contents(public_path($fileName), $audioContent);

            $client->close();
            return response()->json(['success' => true, 'url' => url($fileName)]);
        } catch (\Exception $e) {
            Log::error('Error in TTS synthesis: ' . $e->getMessage());
            return response()->json(['success' => false, 'error' => $e->getMessage()], 500);
        }
    }
}
